<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
class RegisterController extends Controller
{
    public function register(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('auth.resgister');
    }
    public function do_register(Request $request){
        $check_email = User::where('email', $request->email)->first();
        if($check_email){
            return redirect()->back()->with('error',"Email dã tồn tại");
        }
        try {
            DB::beginTransaction();
            // Create a new user
            $user_new = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Attach role (assuming '4' is a role ID)
            $user_new->roles()->attach(4);

            // Attempt to authenticate the user
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (auth()->attempt($credentials)) {
                // If authentication succeeds, check for carts
                $carts = Get_cart(); // Assuming this function retrieves carts
                if (count($carts) > 0) {
                    update_cart_logined($user_new->id); // Assuming this function updates carts for the logged in user
                }

                DB::commit();
                return redirect()->intended('/')->with('success', 'Đăng Ký Thành công!'); // Redirect to intended page after successful registration
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }


    }
}
