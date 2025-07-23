<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Ship;
use App\Models\Variant;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $order;
    private $orderDetail;
    private $product;
    private $payment;
    private $orderStatus;
    private $variant;

    public function __construct(Order $order, OrderDetail $orderDetail, Product $product,Payment $payment,OrderStatus $orderStatus, Ship $ship, Variant $variant){
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->product = $product;
        $this->payment = $payment;
        $this->orderStatus = $orderStatus;
        $this->ship = $ship;
        $this->variant = $variant;
    }
    public function index(){
        $orders = $this->order::all();
        return view('admin.order.index',[
            'orders' => $orders,
        ]);
    }
    public function detail(Request $request){
        $id = $request->id;
        $order = $this->order::find($id);
        $products = $this->orderDetail::where('order_id',$id)->get();
        $modal_page = view('admin.order.modal', [
            'order' => $order,
            'products' => $products,
        ])->render();

        return response()->json([
            'status' => true,
            'modal_page' => $modal_page

        ]);

    }
    public function create(){
        $product_ids = array_unique((new Variant)->product_ids());
        $variant_products = $this->variant->WhereIn('product_id',$product_ids)->get();
        $products = $this->product->whereNotIn('id', $product_ids)->get();
        $statuses = $this->orderStatus->all();
        $payments = $this->payment->all();
        $ships = $this->ship->all();

        return view('admin.order.add',[
            'products' => $products,
            'statuses' => $statuses,
            'payments' => $payments,
            'ships' => $ships,
            'variant_products' => $variant_products,

        ]);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $data =
                [
                    'sku' => RandomString(),
                    'user_id' => Get_id(),
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'phone' =>$request->phone,
                    'address' => $request->address,
                    'status' => $request->status,
                    'ship' => $request->ship,
                    'payment' => $request->payment,
                ];
            $order =  $this->order::create($data);
            $total = 0;

            foreach ($request->products as $key => $val){
                if (strpos($val, ',') !== false) {
                    $order_detail = $this->orderDetail::create([
                        'order_id' => $order->id,
                        'product_id'=> getFirstNumber($val),
                        'quantity' => $request->quantity[$key],
                        'attribute' =>removeFirstNumber($val),
                        'price' => getPriceProduct(getFirstNumber($val),removeFirstNumber($val))

                    ]);
                    $total = $total + $request->quantity[$key] * getPriceProduct(getFirstNumber($val),removeFirstNumber($val));
                }
                else {
                    $order_detail = $this->orderDetail::create([
                        'order_id' => $order->id,
                        'product_id'=> $val,
                        'quantity' => $request->quantity[$key],
                        'price' => getPriceProduct($val),

                    ]);
                    $total = $total + $request->quantity[$key] * getPriceProduct($val);

                }
            }

            $order->total_price = $total;
            $order->save();
            if($order){
                DB::commit();
                return redirect()->route('admin.order.index')->with('success', 'Thêm đơn thành công!');

            }
        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }

    }
    public function edit($id){
        $product_ids =array_unique((new Variant)->product_ids());
        $variant_products = $this->variant->WhereIn('product_id',$product_ids)->get();
        $products = $this->product->whereNotIn('id', $product_ids)->get();
        $statuses = $this->orderStatus->all();
        $payments = $this->payment->all();
        $ships = $this->ship->all();
        $order = $this->order::find($id);
        $order_details = $this->orderDetail::where('order_id',$id)->get();
        return view('admin.order.edit',[
            'order' => $order,
            'order_details' =>$order_details,
            'products' => $products,
            'statuses' => $statuses,
            'payments' => $payments,
            'ships' => $ships,
            'variant_products' => $variant_products,
        ]);
    }
    public function update($id,Request $request){
        try{
            DB::beginTransaction();
            $data =
                [
                    'sku' => RandomString(),
                    'user_id' => Get_id(),
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'phone' =>$request->phone,
                    'address' => $request->address,
                    'status' => $request->status,
                    'ship' => $request->ship,
                    'payment' => $request->payment,
                ];

            $order =  $this->order::find($id);
            $order_update = $order->update($data);
            $total = 0;
            $this->orderDetail->where('order_id', $id)->delete();
            foreach ($request->products as $key => $val){
                if (strpos($val, ',') !== false) {
                    $order_detail = $this->orderDetail::create([
                        'order_id' => $order->id,
                        'product_id'=> getFirstNumber($val),
                        'quantity' => $request->quantity[$key],
                        'attribute' =>removeFirstNumber($val),
                        'price' => getPriceProduct(getFirstNumber($val),removeFirstNumber($val))

                    ]);
                    $total = $total + $request->quantity[$key] * getPriceProduct(getFirstNumber($val),removeFirstNumber($val));
                }
                else {
                    $order_detail = $this->orderDetail::create([
                        'order_id' => $order->id,
                        'product_id'=> $val,
                        'quantity' => $request->quantity[$key],
                        'price' => getPriceProduct($val),

                    ]);
                    $total = $total + $request->quantity[$key] * getPriceProduct($val);

                }
            }

            $order->total_price = $total;
            $order->save();
            if($order){
                DB::commit();
                return redirect()->route('admin.order.index')->with('success', 'Sửa thành công!');

            }
        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }
    }

    public function destroy($id){
        try {
            $order = $this->order->find($id)->delete();
            $order_detail = $this->orderDetail->where('order_id',$id)->delete();

            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true

            ]);

        }
        catch(\Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage(),
                'status' => false

            ]);
        }
    }


    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $orders = Order::where(function($query) use ($q) {
                $query->where('fullname', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%')
                      ->orWhere('sku', 'like', '%'.$q.'%');

            })->get();
            return view('admin.order.index',[
                'orders' => $orders
            ]);
        }
    }
}
