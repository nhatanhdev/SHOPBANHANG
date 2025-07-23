<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(2);
        return response()->json($products,200);
    }

    public function find($id){
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json('Not Found!',404);
        }
        return response()->json($product,200);
    }

    public function create(Request $request){

        $product = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
        ]);

        return response()->json($product,201);

    }

    public function update(Request $request, $id){
        $product = Category::findOrFail($id);
        $product = $product->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
        ]);

        return response()->json($product,200);

    }

    public function delete(Request $request, $id){
        $product = Category::findOrFail($id);
        $product = $product->delete();
        return response()->json(null,204);
    }
}
