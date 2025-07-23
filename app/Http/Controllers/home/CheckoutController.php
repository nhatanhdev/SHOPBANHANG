<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use App\Models\Payment;
use App\Models\Variant;
use Illuminate\Support\Facades\Session;
use App\Models\InfrastructureCity;
use App\Models\InfrastructureDistrict;
use App\Models\InfrastructureWard;
use App\Models\Inventory;
use DB;
class CheckoutController extends Controller
{
    private $cart;
    private $order;
    private $orderDetail;
    private $voucher;
    private $voucherUsed;
    private $payment;
    private $infrastructureCity;
    private $infrastructureDistrict;
    private $infrastructureWard;
    private $inventory;
    private $variant;

    public function __construct(Variant $variant,Payment $payment,Cart $cart,Order $order, OrderDetail $orderDetail, Voucher $voucher, VoucherUsed $voucherUsed,InfrastructureCity $infrastructureCity,InfrastructureDistrict $infrastructureDistrict,InfrastructureWard $infrastructureWard,Inventory $inventory){
        $this->cart = $cart;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->voucher = $voucher;
        $this->voucherUsed = $voucherUsed;
        $this->payment = $payment;
        $this->infrastructureCity = $infrastructureCity;
        $this->infrastructureDistrict = $infrastructureDistrict;
        $this->infrastructureWard = $infrastructureWard;
        $this->inventory = $inventory;
        $this->variant = $variant;

    }
    public function checkout(Request $request){
        $sku = "SP_NA" . RandomString();
        Session::put('sku', $sku);
        $payments = $this->payment::all();
        $infrastructureCity = $this->infrastructureCity::all();
        $carts = Get_cart();
        // $user_id = Get_id();
        $total = 0;
        $reduce = 0;
        foreach ($carts as $item){
            $total += $item->price * $item->quantity;
        }
        if(auth()->check()){
            $voucher = Session::get('voucher_code');
            if ($voucher && now()->lessThanOrEqualTo($voucher['expires_at'])) {
                $code = $voucher['code'];
                if($code){
                    $voucher = $this->voucher->where('code',$code)->where('condition','<=',$total)->first();
                    if($voucher){
                        $sale = $voucher->discount;
                        $money = $voucher->money;
                        if($sale>$money){
                            $reduce =  $sale*$total/100;
                        }
                        else {
                            $reduce =  $money;
                        }
                    }
                }
                // Voucher code is valid
            } else {
                // Voucher code has expired
                Session::forget('voucher_code');
            }


        }

        if($reduce > 0){
            return view('home.checkout',[
                'carts' => $carts,
                'payments' =>$payments,
                'total' => $total,
                'reduce' => $reduce,
                'cities' => $infrastructureCity,
            ]);
        }

        return view('home.checkout',[
            'carts' => $carts,
            'payments' =>$payments,
            'total' => $total,
            'cities' => $infrastructureCity,
        ]);

    }


    public function checkout_order(Request $request){
        $sku = Session::get('sku',0);
        $carts = Get_cart();
        $total = 0;
        foreach($carts as $item){
            $total += $item->price * $item->quantity;
        }
        $user_id = Get_id();
        $name_customer = $request->billing_name;
        $email = $request->billing_email;
        $phone = $request->billing_phone;
        $address = $request->billing_address;
        $note = $request->billing_note;
        $city = $this->infrastructureCity::find($request->billing_city)->name;
        $district = $this->infrastructureDistrict::find($request->billing_district)->name;
        $ward = $this->infrastructureWard::find($request->billing_ward)->name;
        $method_payment = $request->method_payment;
        $address_string = $address. ", ".$ward. ", " .$district. ", " .$city;
        $order = $this->order->create([
            'sku' => $sku,
            'user_id' => $user_id,
            'fullname' => $name_customer,
            'email' => $email,
            'phone' => $phone,
            'address' => $address_string,
            'note' => $note,
            'status' => 1,
            'payment' => $method_payment,
            'ship' => 1,
            'total_price' => $total,
        ]);
        if($order){
            if($method_payment == 3){
                return redirect()->route('vnpayPayment',['id' => $sku]);
            }
            else if($method_payment == 2){
                return redirect()->route('processTransaction');
            }
            else {
                return redirect()->route('checkoutSuccess');
            }
        }

    }
    public function complete_order($sku) {
        $order = $this->order->where('sku',$sku)->first();
        $order_details = $this->orderDetail->where('order_id',$order->id)->get();

        foreach($order_details as $item){
            if($item->attribute == null){
                $inventory = $this->inventory->where('product_id',$item->product_id)->first();
                $quanlity = $inventory->quantity;
                $inventory->quantity = $quanlity - $item->quantity;
                $inventory->save();
            }
            else {
                $variant = $this->variant->where('product_id',$item->product_id)->where('children_id',$item->attribute)->first();
                $quanlity = $variant->quantity;
                $variant->quantity = $quanlity - $item->quantity;
                $variant->save();
            }

        }
        if($order){
            return view('home.checkout_complete', ['sku' => $sku])->with('success', "Đặt Hàng Thành Công");

        }
        return redirect()->route('home.index');

    }


    public function checkoutError(){
        $sku = Session::get('sku',0);
        $user_id = Get_id();
        $order = $this->order->where('sku',$sku)->where('user_id',$user_id)->delete();
        $string = "Xảy ra lỗi vui lòng thử lại";
        return redirect('checkout')->with('error',$string);


    }
    public function checkoutSuccess(){
        try {
            DB::beginTransaction();
            $user_id = Get_id();
            $sku = Session::get('sku',0);
            $id_order = $this->order->where('sku',$sku)->where('user_id',$user_id)->first()->id;
            $carts = Get_cart();
            foreach($carts as $cart) {
                $orderDetail = $this->orderDetail->create([
                    'order_id' => $id_order,
                    'product_id'=> $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'attribute' => $cart->attribute,
                ]);
            }
            if(auth()->check()){
                $voucher = Session::get('voucher_code');
                if ($voucher && now()->lessThanOrEqualTo($voucher['expires_at'])) {
                    $voucher_code = $voucher['code'];
                    if($voucher_code){
                        $voucher = $this->voucher->where('code', $voucher_code)->first();
                        $voucher->time = $voucher->time - 1;
                        $voucher->save();
                        $voucher_used = $this->voucherUsed->create([
                        'user_id' => $user_id,
                        'voucher_id' => $voucher->id,
                    ]);
                    }
                    // Voucher code is valid
                } else {
                    // Voucher code has expired
                    Session::forget('voucher_code');
                }


            }
            $this->cart->where('user_id', $user_id)->delete();
            // Session::forget('sku');
            DB::commit();
            return redirect()->route('home.complete_order', ['sku' => $sku])->with('success', 'Đặt Hàng Thành Công');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkoutError',['string' => $e->getMessage()]);
        }
    }
}
