<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfrastructureDistrict;
use Illuminate\Http\Request;

class InfrastructureDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = InfrastructureDistrict::all();
        return view('admin.infrastructureDistrict.index',
        [
            'districts' => $districts,
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
        $district = InfrastructureDistrict::create([
            'name' => $request->name,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);
        if($district){
            return redirect()->route('admin.InfrastructureDistrict.index')->with('succes','Thêm Thành Công');

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
        $district = InfrastructureDistrict::find($id);
        $modal_edit = view('admin.InfrastructureDistrict.edit', [
            'district' => $district,
        ])->render();
        return response()->json([
            'status' => true,
            'modal_edit' => $modal_edit

        ]);
    }


    public function update(Request $request, $id)
    {
        $district = InfrastructureDistrict::find($id);
        $district->name = $request->name;
        $district->lat = $request->lat;
        $district->long = $request->long;

        $district->save();
        if($district){
            return redirect()->route('admin.InfrastructureDistrict.index')->with('succes','Cập Nhật Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }


    public function destroy($id)
    {
        $district = InfrastructureDistrict::find($id)->delete();
        if($district){
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
            $districts = InfrastructureDistrict::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');

            })->get();
            return view('admin.infrastructureDistrict.index',[
                'districts' => $districts
            ]);
        }
    }
}
