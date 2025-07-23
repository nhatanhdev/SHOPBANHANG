<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderDetail;

class AccountController extends Controller
{
    public function account(){
        $user = User::find(Get_id());
        $orders = Order::where('user_id',Get_id())->orderBy('created_at','desc')->paginate(10);

        return view('home.account',[
            'user' => $user,
            'orders' => $orders,

        ]);
    }

    public function update_account($id,Request $request){
        $user = User::find(Get_id());
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password != null){
            if (Hash::check($request->password, $user->password)) {
                if($request->password_new == $request->confim_password_new)
                $user->password = bcrypt($request->password_new);
                else {
                    return redirect('my-account')->with('error','Mật Khẩu Không Trùng Khớp');
                }
            }
            else {
                return redirect('my-account')->with('error','Mật Khẩu Hiện Tại Không Đúng');
            }
        }
        $user->save();
        return redirect('my-account')->with('success','Cập Nhật Thành Công');


    }

    public function order_detail(Request $request){
        $id = $request->id;
        $order = Order::find($id);
        $products = OrderDetail::where('order_id',$id)->get();
        $modal_page = view('home.partials.order_detail',[
            'order' => $order,
            'products' => $products,
        ])->render();

        return response()->json([
            'status' => true,
            'modal_page' => $modal_page

        ]);

    }

    public function cancel_order(Request $request){
        $id = $request->id;
        $order = Order::find($id);
        $order->status = 6;
        $order->save();

        return response()->json([
            'status' => true,
        ]);


    }
}
