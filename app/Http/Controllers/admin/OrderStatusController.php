<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
class OrderStatusController extends Controller
{
    public function index(){
        $orderStatuses = OrderStatus::all();
        return view('admin.orderStatus.index',
            [
                'orderStatuses' => $orderStatuses
            ]);
    }

    public function create(){
        return response()->json([
            'status' => true,

        ]);
        // return view('admin.orderStatus.add');
    }
    public function store(Request $request){
        $orderStatus = OrderStatus::create([
            'name' =>$request->orderStatus
        ]);
        if($orderStatus){
            return redirect()->route('admin.orderStatus.index')->with('succes','Thêm Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }

    public function edit($id){
        $orderStatus = OrderStatus::find($id);
        $modal_edit = view('admin.orderStatus.edit', [
            'orderStatus' => $orderStatus,
        ])->render();
        return response()->json([
            'status' => true,
            'modal_edit' => $modal_edit

        ]);
    }

    public function update($id,Request $request){
        $orderStatus = OrderStatus::find($id);
        $orderStatus->name = $request->orderStatus;
        $orderStatus->save();
        if($orderStatus){
            return redirect()->route('admin.orderStatus.index')->with('succes','Cập Nhật Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }
    public function destroy($id){
        $orderStatus = OrderStatus::find($id)->delete();
        if($orderStatus){
            return response()->json([
                'message'=> 'Xóa Thành Công!',
                'status' => true
            ]);
        }
        else {
            return response()->json([
                'message'=> 'Xảy ra lỗi!',
                'status' => false
            ]);

        }

    }

    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $orderStatuses = orderStatus::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.orderStatus.index',[
                'orderStatuses' => $orderStatuses
            ]);
        }
    }
}
