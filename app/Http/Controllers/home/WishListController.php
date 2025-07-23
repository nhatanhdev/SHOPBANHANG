<?php

namespace App\Http\Controllers\home;

use App\Models\WishList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class WishListController extends Controller
{

    public function index()
    {
        $products = WishList::paginate(9)->onEachSide(1);
        // dd($products[0]->products->id);
        $arr_wishlist = [];
        if(auth()->check()) {
            $wishlist = WishList::where('user_id', auth()->user()->id)->get();
            $arr_wishlist = $wishlist->pluck('product_id')->toArray();
        }
        return view('home.wishlist', [
            'products' => $products,
            'arr_wishlist' => $arr_wishlist
        ]);
    }

    public function add($id)
    {
        if(!(auth()->check())) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lý đăng nhập để xử dụng chức năng'
            ]);
        }
        $user_id = Get_id();
        $product = Product::find($id);
        $check = WishList::where('user_id', $user_id)->where('product_id', $id)->first();
        if($check) {
            $check->delete();
            return response()->json([
                'status' => 201,
                'message' => 'Đã Xóa Khỏi Yêu Thích'
            ]);
        }
        $data = [
            'user_id' => $user_id,
            'product_id' => $id,
        ];
        $add_wishlist = WishList::create($data);
        if($add_wishlist) {
            return response()->json([
                'id' => $id,
                'status' => 200,
                'message' => 'Thêm vào yêu thích thành công'
            ]);
        }
        return response()->json([
           'status' => false,
           'message' => 'Xảy ra lỗi '
        ]);
    }
}




