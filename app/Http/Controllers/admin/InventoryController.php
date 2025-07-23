<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventorys = Inventory::all();
        return view('admin.inventory.index',[
            'inventorys' => $inventorys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('admin.inventory.edit',[
            'inventory' => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory, $id)
    {
        $inventory = Inventory::find($id)->update($request->all());
        if($inventory){
            return redirect()->route('admin.inventory.index')->with('success','Cập Nhật Thành Công');

        }
        return redirect()->back()->with('error','Xảy ra Lỗi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Inventory $inventory)
    {
        try{

            DB::beginTransaction();
            $inventory = Inventory::find($id);
            $product_id = $inventory->product_id;
            $inventory->delete();
            $product = Product::find($product_id)->delete();
            DB::commit();
            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true

            ]);

        }

        catch (\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message'=> $exception->getMessage(),
                'status' => false

            ]);        }
    }


    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $inventorys = Inventory::where(function($query) use ($q) {
                $query->where('product_name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.inventory.index',[
                'inventorys' => $inventorys
            ]);
        }
    }
}
