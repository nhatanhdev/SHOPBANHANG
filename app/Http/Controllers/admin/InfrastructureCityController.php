<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfrastructureCity;
use Illuminate\Http\Request;
class InfrastructureCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citys = InfrastructureCity::all();
        return view('admin.infrastructureCity.index',
        [
            'citys' => $citys,
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
        $city = InfrastructureCity::create([
            'name' => $request->name,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);
        if($city){
            return redirect()->route('admin.infrastructureCity.index')->with('succes','Thêm Thành Công');

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
        $city = InfrastructureCity::find($id);
        $modal_edit = view('admin.infrastructureCity.edit', [
            'city' => $city,
        ])->render();
        return response()->json([
            'status' => true,
            'modal_edit' => $modal_edit

        ]);
    }


    public function update(Request $request, $id)
    {
        $city = InfrastructureCity::find($id);
        $city->name = $request->name;
        $city->lat = $request->lat;
        $city->long = $request->long;

        $city->save();
        if($city){
            return redirect()->route('admin.infrastructureCity.index')->with('succes','Cập Nhật Thành Công');
        }
        else {
            return redirect()->back()->with('error','Xảy Ra Lỗi');
        }
    }


    public function destroy($id)
    {
        $city = InfrastructureCity::find($id)->delete();
        if($city){
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
            $citys = InfrastructureCity::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');

            })->get();
            return view('admin.infrastructureCity.index',[
                'citys' => $citys
            ]);
        }
    }
}
