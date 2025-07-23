<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Variant;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $variant;
    private $product;
    private $cart;
    private $category;
    public function __construct(Product $product, Cart $cart, Category $category, Variant $variant){
        $this->product = $product;
        $this->cart = $cart;
        $this->category = $category;
        $this->variant = $variant;

    }


    public function index()
    {
        //
        $carts = Get_cart();
        return view('home.cart',[
            'carts' => $carts
        ]);
    }
    public function add($id, Request $request){

        $quantity = $request->quantity;
        if(!$quantity){
            $quantity = 1;
        }
        $attrs = $request->arr;

        if($attrs != null && count($attrs) > 0){
            $attr = implode(',',$attrs);
        }
        $product = Product::find($id);
        $user_id = Get_id();
        if($attrs != null && count($attrs) > 0){
            $cart = $this->cart->where('user_id', $user_id)
            ->where('product_id', $id)->where('attribute', $attr)
            ->first();
        }
        else {
            $cart = $this->cart->where('user_id', $user_id)
            ->where('product_id', $id)
            ->first();
        }
        if ($cart) {
            if($attrs == null){
                if($cart->quantity + $quantity > $cart->inventory->quantity){
                    return response()->json([
                        'status' => false,
                        'message' => 'Out of stock',
                    ]);
                }
            }
            else {
                $variant = $this->variant->where('children_id', $attr)->where('product_id', $id)->first();
                if($variant->quantity < $cart->quantity + $quantity){
                    return response()->json([
                        'status' => false,
                        'message' => 'Out of stock',
                    ]);
                }
            }

            $data = [
                'quantity' => $cart->quantity + $quantity
            ];
            $this->cart->where('user_id', $user_id)
                ->where('product_id', $id)
                ->update($data);
        }
        else{
           $data = array(
            'user_id' => $user_id,
            'product_id' =>$id,
            'name' =>$product->name,
            'image_path' => $product->feature_image,
            'price' => $product->price,
            'quantity' => $quantity,
            );
            if($attrs != 0){
                $data['attribute'] = $attr;
            }
            $this->cart->create($data);
        }
        // session()->put('cart', $carts);
        $carts = $this->cart->where('user_id', $user_id)->get();
        // $page_cart = view('home.partials.page_cart', ['carts' => $carts])->render();
        $mini_cart = view('home.partials.mini_cart', ['carts' => $carts])->render();
        return response()->json([
            'status' => true,
            'message' => 'Product added successfully',
            'quantity_cart' => count($carts),
            'mini_cart' => $mini_cart
        ]);
    }

    public function update(Request $request){
        $user_id = Get_id();
        $id = $request->id;
        $cart =  $this->cart->where('user_id', $user_id)
            ->where('id', $id)
            ->first();
        if ($cart) {
            $cart->update(['quantity' => $request->quantity]);
            $carts = $this->cart->where('user_id',$user_id)->get();

            $page_cart = view('home.partials.page_cart', ['carts' => $carts])->render();
            $mini_cart = view('home.partials.mini_cart', ['carts' => $carts])->render();

            return response()->json([
                'status' => true,
                'message' => 'Cart updated successfully',
                'page_cart' => $page_cart,
                'quantity_cart' => count($carts),
                'mini_cart' => $mini_cart

            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Cart updated error',


            ]);
        }



    }
    public function remove(Request $request){
        $user_id = Get_id();
        $product_id = $request->id;
        $cart =  $this->cart->where('user_id', $user_id)
            ->where('id', $product_id)
            ->first();
        if($cart){
            $cart->delete();
            $carts = $this->cart->where('user_id',$user_id)->get();
            // $page_cart = view('home.partials.page_cart', ['carts' => $carts])->render();
            $mini_cart = view('home.partials.mini_cart', ['carts' => $carts])->render();
            return response()->json([
               'status' => true,
               'message' => 'Cart removed successfully',
               'quantity_cart' => count($carts),
                // 'page_cart' => $page_cart,
                'mini_cart' => $mini_cart
            ]);
        }
        else {
            return response()->json([
               'status' => false,
               'message' => 'Cart removed error',
            ]);
        }
    }
    // public function clear(){
    //     $user_id = Get_id();
    //     $cart =  $this->cart->where('user_id', $user_id)->delete();
    //     if($cart){
    //         $carts = Get_cart();
    //         $page_cart = view('home.partials.page_cart', ['carts' => $carts])->render();
    //         $mini_cart = view('home.partials.cart_mini', ['carts' => $carts])->render();
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Cart cleared successfully',
    //             'page_cart' => $page_cart,
    //             'mini_cart' => $mini_cart
    //         ]);
    //     }
    //     else{
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Cart cleared error',
    //             'page_cart' => $page_cart,
    //             'mini_cart' => $mini_cart
    //         ]);
    //     }
    // }

    public function check_attr(Request $request){
        $product_id = $request->id;
        $attrs = $request->arr;
        $attr = implode(',',$attrs);
        $variant = $this->variant->where('children_id', $attr)->where('product_id', $product_id)->first();
        return response()->json([
            'status' => true,
            'quantity' => $variant->quantity,
            'variant' =>$variant,
        ]);
    }


}
