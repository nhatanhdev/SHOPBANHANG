<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::all();
        return view('admin.payment.index',
            [
                'payments' => $payments
            ]);
    }

    public function create(){
        return response()->json([
            'status' => true,
        ]);
    }
    public function store(Request $request){
        $payment = Payment::create([
            'name' =>$request->payment
        ]);
        if($payment){
            return redirect()->route('admin.payment.index')->with('succes','Thêm Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }

    public function edit($id){
        $payment = Payment::find($id);
        $modal_edit = view('admin.payment.edit', [
            'payment' => $payment,
        ])->render();
        return response()->json([
            'status' => true,
            'modal_edit' => $modal_edit

        ]);
    }

    public function update($id,Request $request){
        $payment = Payment::find($id);
        $payment->name = $request->payment;
        $payment->save();
        if($payment){
            return redirect()->route('admin.payment.index')->with('succes','Cập Nhật Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }
    public function destroy($id){
        $payment = Payment::find($id)->delete();
        if($payment){
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
            $payments = Payment::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.payment.index',[
                'payments' => $payments
            ]);
        }
    }


}
