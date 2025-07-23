<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleStatistic;
use App\Models\Order;

use Illuminate\Http\Request;

class SaleStatisticController extends Controller
{
    public function __construct()
    {
        $this->prefixView = "saleStatisc";

    }
    public function index()
    {
        $year = 2024;
        $list_orders = Order::all();
        $orders = Get_total_moth($year);
        $data = [];
        $profit = [];
        $total = 0;
        $total_profix = 0;
        $total_order =  count($list_orders);
        foreach ($orders as $order){
            $total = $total + $order->total_amount;
            $data[] = $order->total_amount;
            $profit[] = intval($order->total_amount/rand(2,5));
            $total_profix = $total_profix + intval($order->total_amount/rand(2,5));
        }
        return view('admin.' . $this->prefixView . '.index',[

            'data' => $data,
            'profit' => $profit,
            'total' => $total,
            'total_profix' => $total_profix,
            'total_order' => $total_order,
            'year' => $year,
            'orders' =>$orders



        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleStatistic  $saleStatistic
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $year = $request->year;
        $list_orders = Order::whereYear('created_at', $year)->get();
        $orders = Get_total_moth($year);
        $data = [];
        $profit = [];
        $total = 0;
        $total_profix = 0;
        $total_order =  count($list_orders);
        foreach ($orders as $order){
            $total = $total + $order->total_amount;
            $data[] = $order->total_amount;
            $profit[] = intval($order->total_amount/rand(2,5));
            $total_profix = $total_profix + intval($order->total_amount/rand(2,5));
        }
        $data = count($data) ==  0 ? [0,0,0,0,0,0,0,0,0,0,0,0] : $data ;
        $profit = count($profit) ==0  ? [0,0,0,0,0,0,0,0,0,0,0,0] : $profit ;
        $data_statstic = view('admin.' . $this->prefixView . '.chartjs',[
            'data' => $data,
            'profit' => $profit,
            'total' => $total,
            'total_profix' => $total_profix,
            'total_order' => $total_order,
            'year' => $year,
            'orders' =>$orders
        ])->render();

        return response()->json([
            'status' => true,
            'data_statstic' => $data_statstic,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleStatistic  $saleStatistic
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleStatistic  $saleStatistic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleStatistic $saleStatistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleStatistic  $saleStatistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleStatistic $saleStatistic)
    {
        //
    }


}
