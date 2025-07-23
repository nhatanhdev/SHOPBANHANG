<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfrastructureWard;
use Illuminate\Http\Request;

class InfrastructureWardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = InfrastructureWard::all();
        return view('admin.infrastructureWard.index',
        [
            'wards' => $wards,
        ]);
    }


    public function create()
    {
        return response()->json([
            'status' => true,
        ]);
    }


    public function store(Request $request)
    {
        $ward = InfrastructureWard::create([
            'name' => $request->name,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);
        if($ward){
            return redirect()->route('admin.infrastructureWard.index')->with('succes','Thêm Thành Công');

        }
        else{
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $ward = InfrastructureWard::find($id);
        $modal_edit = view('admin.infrastructureWard.edit', [
            'ward' => $ward,
        ])->render();
        return response()->json([
            'status' => true,
            'modal_edit' => $modal_edit

        ]);
    }


    public function update(Request $request, $id)
    {
        $ward = InfrastructureWard::find($id);
        $ward->name = $request->name;
        $ward->lat = $request->lat;
        $ward->long = $request->long;

        $ward->save();
        if($ward){
            return redirect()->route('admin.infrastructureWard.index')->with('succes','Cập Nhật Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }


    public function destroy($id)
    {
        $ward = InfrastructureWard::find($id)->delete();
        if($ward){
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
            $wards = InfrastructureWard::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');

            })->get();
            return view('admin.infrastructureWard.index',[
                'wards' => $wards
            ]);
        }
    }
}
