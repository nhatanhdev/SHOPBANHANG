<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seos = Seo::all();
        return view('admin.seo.index',
        [
            'seos' => $seos
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
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function show(Seo $seo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function edit(Seo $seo,$id)
    {
        $seo = Seo::find($id);
        return view('admin.seo.edit',
        [
            'seo' => $seo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seo $seo,$id)
    {
        $seo = Seo::find($id);
        $update_seo = $seo->update($request->all());
        if($update_seo){
            return redirect()->route('admin.seo.index')->with('success', 'Cập nhật thành công!');

        }
        return redirect()->back()->with('error', 'Xảy ra lỗi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seo  $seo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo)
    {
        //
    }
}
