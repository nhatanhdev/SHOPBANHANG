<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\VoucherUsed;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
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
    public function voucher_add(Request $request){
        if(!auth()->check()){
            return response()->json([
                'status' => false,
                'message' => 'Vui Lòng Đăng Nhập Để Sử Dụng Chức Năng Này'
            ]);
        }
        $date = date("Y/m/d");
        $carts = Get_cart();
        $total = 0;
        $user_id = Get_id();
        $code = $request->code;
        foreach($carts as $item){
            $total += $item->price * $item->quantity;
        }
        $voucher = $this->voucher->where('code',$code)->where('condition','<=',$total)->first();
        if($voucher){
            $voucher_id = $voucher->id;
            $voucher_used = $this->voucherUsed->where('voucher_id',$voucher_id)->where('user_id',$user_id)->first();
            if($voucher_used){
                return response()->json([
                    'status' => false,
                    'message' =>'Bạn Đã Sử Dụng Mã Giảm Giá Này Rồi',
                ]);
            }
            else if( $voucher->time == 0 ){
                return response()->json([
                    'status' => false,
                    'message' =>'Voucher này đã hết lượt sử dụng',
                ]);
            }
            else if (strtotime($voucher->expiration_date) < strtotime($date)){
                return response()->json([
                    'status' => false,
                    'message' =>'Voucher này đã hết hạn sử dụng',
                ]);
            }
            else {
                $carts = Get_cart();
                if($voucher->discount > $voucher->money){
                    $reduce = $voucher->discount * $total / 100;
                }
                else {
                    $reduce = $voucher->money;

                }

                $page_cart = view('home.partials.page_cart', ['reduce' => $reduce ,'code' => $code, 'carts' => $carts])->render();
                Session::put('voucher_code', ['code' => $code, 'expires_at' => now()->addMinutes(5)]);
                return response()->json([
                    'status' => true,
                    'message' =>'Áp Dụng Mã Giảm Giá Thành Công',
                    'page_cart' => $page_cart,
                ]);
            }
        }
        else {
            return response()->json([
                'status' => false,
                'message' => "Mã Không Hợp Lệ"
            ]);
        }

    }
}
