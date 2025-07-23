<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;


class FlashSaleController extends Controller
{


    public function index()
    {
        $flashSales = FlashSale::all();
        return view('admin.flashSale.index',[
            'flashSales' => $flashSales
        ]);
    }


    public function create()
    {
        $product_ids = array_unique((new Variant)->product_ids());
        $products = Product::whereNotIn('id', $product_ids)->get();
        return view('admin.flashSale.add',[
            'products' => $products,
        ]);
    }


    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'product_id' => 'required',
        //     'reduce_price' => 'required',
        //     'quantity' => 'required',
        //     'start_date' => 'required',
        //     'end_date' => 'required',
        // ]);

        $flashSale = FlashSale::create([
            'product_id' => $request->product_id,
            'reduce_price' => $request->reduce_price,
            'quantity' => $request->quantity,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'end_date' => date('Y-m-d', strtotime($request->end_date)),
        ]);
        if($flashSale){
            return redirect()->route('admin.flashSale.index')->with('success','Flash sale created successfully');

        }
        return redirect()->back()->with('error','Something went wrong');


    }


    public function show(FlashSale $flashSale)
    {
        //
    }


    public function edit($id, FlashSale $flashSale)
    {
        $flashSale = FlashSale::find($id);
        $product_ids = array_unique((new Variant)->product_ids());
        $products = Product::whereNotIn('id', $product_ids)->get();
        return view('admin.flashSale.edit',[
            'flashSale' => $flashSale,
            'products' => $products,
        ]);
    }


    public function update(Request $request, $id)
    {
        $flashSale = FlashSale::find($id)->update([
            'product_id' => $request->product_id,
            'reduce_price' => $request->reduce_price,
            'quantity' => $request->quantity,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'end_date' => date('Y-m-d', strtotime($request->end_date)),
        ]);
        if($flashSale){
            return redirect()->route('admin.flashSale.index')->with('success','Flash sale updated successfully');

        }
        return redirect()->back()->with('error','Something went wrong');

    }


    public function destroy(FlashSale $flashSale, $id)
    {
        $flashSale = FlashSale::find($id)->delete();
        if($flashSale){
            return response()->json([
                'message'=> 'Xóa Thành Công!',
                'status' => true
            ]);
        }

        return response()->json([
            'message'=> 'Xảy ra lỗi!',
            'status' => false
        ]);


    }
}
