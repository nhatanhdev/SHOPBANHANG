<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
class ProvinceController extends Controller
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
    public function index(){
        $client = new Client();

        try {
            // Make the HTTP request to your own API
            $response = $client->get('http://localhost:8000/api/city');

            // Get the response body
            $body = $response->getBody();

            // Decode the JSON response
            $data = json_decode($body);
            return response()->json($data, 200);
            // Dump and die the data
        } catch (RequestException $e) {
            // Handle the exception if the request fails
            echo "HTTP Request failed\n";
            echo $e->getMessage();
        }
    }


    public function districts(Request $request){
        $id_city = $request->id;
        $view2 = view('home.ajax.ward')->render();
        if($id_city!= 0){
            $districts = $this->infrastructureDistrict->where('city_id',$id_city)->get();
            if($districts){
                $views = view('home.ajax.district', ['districts' => $districts])->render();
                return response()->json([
                    'status' => true,
                    'views' => $views,
                    'view2' => $view2,

                ]);
            }
        }
        $views = view('home.ajax.district')->render();

        return response()->json([
            'status' => false,
            'views' => $views,
            'view2' => $view2,

        ]);
    }


    public function wards(Request $request){
        $district_id = $request->id;
        if($district_id!= 0){
            $wards = $this->infrastructureWard->where('district_id',$district_id)->get();
            $views = view('home.ajax.ward', ['wards' => $wards])->render();
            return response()->json([
                'status' => true,
                'views' => $views,
            ]);

        }
        $views = view('home.ajax.ward')->render();
        return response()->json([
            'status' => false,
            'views' => $views,

        ]);
    }
}
