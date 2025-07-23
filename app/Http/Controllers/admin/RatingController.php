<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = Rating::all();
        return view('admin.rating.index',[
            'ratings' => $ratings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $users = User::all();
        $products = Product::all();
        return view('admin.rating.add',[
            'users' => $users,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rating = Rating::create($request->all());
        if($rating)
        {
            return redirect()->route('admin.rating.index')->with('success', 'Thêm thành công!');

        }

            return redirect()->back()->with('error', 'Xảy ra lỗi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating,$id)
    {
        $rating = Rating::find($id);
        $users = User::all();
        $products = Product::all();
        return view('admin.rating.edit',[
            'rating' => $rating,
            'users' => $users,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating,$id)

    {
       $rating = Rating::find($id);
       $update = $rating->update($request->all());
       if($update){
        return redirect()->route('admin.rating.index')->with('success', 'Cập nhật thành công!');
        }
        return redirect()->back()->with('error', 'Xảy ra lỗi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating,$id)
    {
        $rating = Rating::find($id)->delete();
        if($rating){
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
            $ratings = Rating::where(function($query) use ($q) {
                $query->where('content', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.rating.index',[
                'ratings' => $ratings
            ]);
        }
    }
}
