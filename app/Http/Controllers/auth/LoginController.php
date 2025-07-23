<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
class LoginController extends Controller
{
    function login(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('auth.login');
    }

    function adminlogin(){
        if(auth()->check()){
            return redirect('admin/dashboard');
        }
        return view('auth.admin-login');
    }

    public function admin_do_login(Request $request){
        if ($request->email == "" || $request->password == "") {
            return redirect('admin')->with('error', 'Email or password is empty.');
        }

        $credentials = $request->only('email','password');
        if (auth()->attempt($credentials)) {
            $user_id = session()->get('user_id');
            // if($user_id){
            //     Cart::where('user_id', $user_id)
            //     ->update(['user_id' => auth()->id()]);
            //     $array = [];
            //     $Carts = Cart::where('user_id',auth()->id())->get();
            //     foreach($Carts as $cart){
            //     $array[] = $cart->product_id;
            //     }
            //     $collection= collect($array);
            //     $duplicates = $collection->duplicates();
            //     foreach($duplicates->all() as $product_id){
            //         $quantity = 0;
            //         $cart_news = Cart::where('user_id',auth()->id())->where('product_id',$product_id)->get();
            //         foreach($cart_news as $item){
            //             $quantity += $item->quantity;
            //         }
            //         $Cart_index = Cart::where('user_id', auth()->id())
            //         ->where('product_id', $product_id)->get();

            //         $carts_to_delete = Cart::where('user_id', auth()->id())
            //             ->where('product_id', $product_id)
            //             ->skip(1) // bỏ qua 1 sản phẩm cuối cùng
            //             ->take($Cart_index->count() - 1) // lấy số lượng sản phẩm cần xóa
            //             ->get();

            //         // Xóa các sản phẩm
            //         foreach ($carts_to_delete as $cart) {
            //             $cart->delete();
            //         }
            //         // Cập nhật số lượng sản phẩm còn lại
            //         foreach ($Cart_index as $cart) {
            //             $cart->update(['quantity' => $quantity]);
            //         }
            //     }
            // }
            update_cart_logined($user_id);
            return redirect()->intended('admin/dashboard');

        }
        return redirect('admin')->with('error', 'Email or password is wrong.');


    }

    function do_login(Request $request){
        if ($request->email == "" || $request->password == "") {
            return redirect('login')->with('error', 'Email or password is empty.');
        }
        $credentials = $request->only('email','password');
        if (auth()->attempt($credentials)) {
            $user_id = session()->get('user_id');
            update_cart_logined($user_id);
            return redirect()->intended('/');

        }
        return redirect('login')->with('error', 'Email or password is wrong.');


    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
