<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use DB;

class PayPalController extends Controller
{
     /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    private $cart;
    private $order;
    private $orderDetail;
    private $voucher;
    private $voucherUsed;
    public function __construct(Cart $cart,Order $order, OrderDetail $orderDetail, Voucher $voucher, VoucherUsed $voucherUsed){
        $this->cart = $cart;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->voucher = $voucher;
        $this->voucherUsed = $voucherUsed;

    }
    public function paypal_complete($sku){
        $order = $this->order->where('sku',$sku)->first();
        if($order){
            return view('home.checkout_complete', ['sku' => $sku])->with('success', "Đặt Hàng Thành Công");

        }
        return redirect()->route('home.index');
    }
    // public function paypal_error()
    // {
    //     $carts = Get_cart();
    //     return view('home.checkout',[
    //         'carts' => $carts,
    //     ]);
    // }
    // public function paypal_success(){
    //     try {
    //         DB::beginTransaction();
    //         $user_id = Get_id();
    //         $sku = Session::get('sku',0);
    //         $id_order = $this->order->where('sku',$sku)->where('user_id',$user_id)->first()->id;
    //         $carts = Get_cart();
    //         foreach($carts as $cart) {
    //             $orderDetail = $this->orderDetail->create([
    //                 'order_id' => $id_order,
    //                 'product_id'=> $cart->product_id,
    //                 'quantity' => $cart->quantity,
    //                 'price' => $cart->price,
    //                 'attribute' => $cart->attribute,
    //             ]);
    //         }
    //         if(auth()->check()){
    //             $voucher = Session::get('voucher_code');
    //             if ($voucher && now()->lessThanOrEqualTo($voucher['expires_at'])) {
    //                 $voucher_code = $voucher['code'];
    //                 if($voucher_code){
    //                     $voucher = $this->voucher->where('code', $voucher_code)->first();
    //                     $voucher->time = $voucher->time - 1;
    //                     $voucher->save();
    //                     $voucher_used = $this->voucherUsed->create([
    //                     'user_id' => $user_id,
    //                     'voucher_id' => $voucher->id,
    //                 ]);
    //                 }
    //                 // Voucher code is valid
    //             } else {
    //                 // Voucher code has expired
    //                 Session::forget('voucher_code');
    //             }


    //         }
    //         $this->cart->where('user_id', $user_id)->delete();
    //         // Session::forget('sku');
    //         DB::commit();
    //         return redirect()->route('home.complete_order', ['sku' => $sku])->with('success', 'Đặt Hàng Thành Công');
    //     }
    //     catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->route('paypal_error')->with('error', $e->getMessage());
    //     }

    // }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {   $sku = Session::get('sku',0);
        $user_id = Get_id();
        $total = $this->order->where('sku',$sku)->where('user_id',$user_id)->first()->total_price;
        $price_usd = round($total/Api_Rate_USD(),1);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('checkoutSuccess'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price_usd
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('paypal_error')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('paypal_error')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            return redirect()
                ->route('paypal_success')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('paypal_error')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
        ->route('checkoutError')->with('error', $response['message'] ?? 'Something went wrong.');

    }
}
