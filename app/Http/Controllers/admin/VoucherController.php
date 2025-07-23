<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
class VoucherController extends Controller
{
    public function index(){
        $vouchers = Voucher::all();
        return view('admin.voucher.index',
            [
                'vouchers' => $vouchers,
            ]);
    }

    public function create(){
        return view('admin.voucher.add');
    }
    public function store(Request $request){
        $date = date('Y-m-d', strtotime($request->expiration_date));
        if(!$date){
            return redirect()->back()->with('error','Vui Lòng Chọn Ngày Hết Hạn');

        }
        $code = $request->code;

        $voucher = Voucher::where('code', $code)->first();
        if($voucher){
            return redirect()->back()->with('error','Mã này đã tồn tại');
        }
        if($request->check == 1){
            $data = [
                'name' => $request->name,
                'code' => $code,
                'time' => $request->time,
                'discount' => $request->discount,
                'condition' => $request->condition,
                'expiration_date' => $date,
            ];
        }
        else if ($request->check == 2){
            $data = [
                'name' => $request->name,
                'code' => $code,
                'time' => $request->time,
                'money' => $request->money,
                'condition' => $request->condition,
                'expiration_date' => $date,
            ];
        }
        else {
            return redirect()->back()->with('error','Mã này giảm theo tiền hay % ?');

        }

        $voucher_new = Voucher::create($data);
        if($voucher_new){
            return redirect()->route('admin.voucher.index')->with('success','Thêm Vouche Thành Công');

        }
        else{
            return redirect()->back()->with('error','Something wrong');;
        }
    }

    public function edit($id){
        $voucher = Voucher::find($id);
        return view('admin.voucher.edit',[
            'voucher' => $voucher
        ]);

    }


    public function update($id, Request $request){
        $voucher_update = Voucher::find($id);
        $date = date('Y-m-d', strtotime($request->expiration_date));
        if(!$date){
            return redirect()->back()->with('error','Vui Lòng Chọn Ngày Hết Hạn');

        }
        $code = $request->code;
        // if($code != $voucher_update->code){
        //     $voucher = Voucher::where('code', $code)->first();
        //     if($voucher){
        //         return redirect()->back()->with('error','Mã này đã tồn tại');
        //     }
        // }
        if($request->check == 1){
            $data = [
                'name' => $request->name,
                'code' => $code,
                'time' => $request->time,
                'discount' => $request->discount,
                'condition' => $request->condition,
                'expiration_date' => $date,
            ];
        }
        else if ($request->check == 2){
            $data = [
                'name' => $request->name,
                'code' => $code,
                'time' => $request->time,
                'money' => $request->money,
                'condition' => $request->condition,
                'expiration_date' => $date,
            ];
        }
        else {
            return redirect()->back()->with('error','Mã này giảm theo tiền hay % ?');

        }

        $voucher_update = Voucher::where('id',$id)->update($data);
        if($voucher_update){
            return redirect()->route('admin.voucher.index')->with('success','Cập Nhật Vouche Thành Công');

        }
        else{
            return redirect()->back()->with('error','Something wrong');;
        }
    }

    public function destroy($id){
        $voucher = Voucher::find($id)->delete();
        if($voucher){
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
            $vouchers = Voucher::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%')
                      ->orWhere('code', 'like', '%'.$q.'%');
            })->get();
            return view('admin.voucher.index',[
                'vouchers' => $vouchers
            ]);
        }
    }
}
