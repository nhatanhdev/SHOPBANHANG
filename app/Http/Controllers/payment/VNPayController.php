<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Voucher;
use App\Models\VoucherUsed;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use App\Models\InfrastructureCity;
use App\Models\InfrastructureDistrict;
use App\Models\InfrastructureWard;
use DB;
class VNPayController extends Controller
{
    public function __construct(Payment $payment,Cart $cart,Order $order, OrderDetail $orderDetail, Voucher $voucher, VoucherUsed $voucherUsed,InfrastructureCity $infrastructureCity,InfrastructureDistrict $infrastructureDistrict,InfrastructureWard $infrastructureWard){
        $this->cart = $cart;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->voucher = $voucher;
        $this->voucherUsed = $voucherUsed;
        $this->payment = $payment;
        $this->infrastructureCity = $infrastructureCity;
        $this->infrastructureDistrict = $infrastructureDistrict;
        $this->infrastructureWard = $infrastructureWard;

    }
    public function VnPay($sku,Request $request){
        $user_id = Get_id();
        // $sku = Session::get('sku',0);
        $total = Order::where('sku',$sku)->where('user_id',$user_id)->first()->total_price;

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = config('vnpay.vnpay.redirect');
        $vnp_TmnCode = config('vnpay.vnpay.client_id');
        $vnp_HashSecret = config('vnpay.vnpay.client_secret');//Chuỗi bí mật
        $vnp_TxnRef = $sku;
        $vnp_OrderInfo = "Thanh Toán Sản Phẩm ".  $sku;
        $vnp_OrderType = "Hàng Hóa";

        $vnp_Amount = $total * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($sku)) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo

        }

    // public function is_success(){


    // }

}
