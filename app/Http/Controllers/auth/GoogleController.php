<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleredirect()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('auth_id', $user->id)->first();
            $user_id = session()->get('user_id');

            if ($finduser) {
                Auth::login($finduser);
                update_cart_logined($user_id);
                return redirect()->intended('/')->with('success', 'Login Thành Công');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'auth_id' => $user->id,
                    'password' => Hash::make('123456') // Use Hash::make instead of encrypt
                ]);

                Auth::login($newUser);
                update_cart_logined($user_id);
                return redirect()->intended('/')->with('success', 'Login Thành Công');
            }
        } catch (Exception $e) {
            return redirect('login')->with('error', $e->getMessage());
        }
    }
}
