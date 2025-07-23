<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Models\WishList;
use App\Models\Inventory;
use App\Models\Tag;
use App\Models\Rating;
use App\Models\Order;
use App\Models\OrderDetail;

use Breadcrumbs;

class HomeController extends Controller
{
    private $slider;
    private $product;
    private $category;
    private $productImage;
    private $wishList;
    private $inventory;
    private $variant;
    private $rating;
    private $order;
    private $order_detail;
    public function __construct(OrderDetail $order_detail,Order $order,Inventory $inventory,WishList $wishList,Slider $slider,Product $product,Category $category,Variant $variant,Attribute $attribute,ProductImage $productImage, Rating $rating){
        $this->slider = $slider;
        $this->product = $product;
        $this->category = $category;
        $this->variant = $variant;
        $this->attribute = $attribute;
        $this->productImage = $productImage;
        $this->wishList = $wishList;
        $this->inventory = $inventory;
        $this->rating = $rating;
        $this->order = $order;
        $this->order_detail = $order_detail;

    }
    public function index(){
        $sliders = $this->slider->all();
        $products = $this->product->limit(6)->get();
        return view('home.index',[
            'sliders' => $sliders,
            'products' => $products
        ]);
    }

    public function search(Request $request){
        $list = list_attr_name();
        $query  = $request->q;
        $products = filter_product($list,$query);
        $categories = $this->category
        ->where('parent_id', 0)
        ->withCount('products')
        ->get();

        $attributes = $this->attribute->where('parent_id', 0)->get();
        if(auth()->check()) {
            $wishlist = $this->wishList->where('user_id', auth()->user()->id)->get();
            $arr_wishlist = $wishlist->pluck('product_id')->toArray();
        }

        $all_products = $this->product->all();
        return view('home.search',[
            'categories' => $categories,
            'products' => $products,
            'attributes' =>$attributes,
            'query' => $query,
            'all_products' => $all_products,
            'list' => $list,
            'arr_wishlist' => $arr_wishlist,

        ]);
    }

    public function product(Request $request)
    {
        $list = list_attr_name();
        $products = filter_product($list);

        $categories = $this->category
            ->where('parent_id', 0)
            ->get();

        $attributes = $this->attribute->where('parent_id', 0)->get();
        $all_products = $this->product->all();
        $arr_wishlist = [];
        if(auth()->check()) {
            $wishlist = $this->wishList->where('user_id', auth()->user()->id)->get();
            $arr_wishlist = $wishlist->pluck('product_id')->toArray();
        }

        return view('home.product', [
            'categories' => $categories,
            'products' => $products,
            'attributes' =>$attributes,
            'all_products' => $all_products,
            'arr_wishlist' => $arr_wishlist,
            'list' => $list,
            'slug' => '0',


        ]);
    }

    public function product_slug($slug){

        $list = list_attr_name();
        $category = $this->category->where('slug',$slug)->first()->id;
        $products = filter_product($list,'',$category);
        $categories = $this->category
            ->where('parent_id', 0)
            ->get();
        $attributes = $this->attribute->where('parent_id', 0)->get();
        $all_products = $this->product->all();
        $arr_wishlist = [];
        if(auth()->check()) {
            $wishlist = $this->wishList->where('user_id', auth()->user()->id)->get();
            $arr_wishlist = $wishlist->pluck('product_id')->toArray();
        }
        return view('home.product',[
            'categories' => $categories,
            'products' => $products,
            'attributes' =>$attributes,
            'all_products' => $all_products,
            'arr_wishlist' => $arr_wishlist,
            'list' => $list,
            'slug' => $slug,
        ]);
    }
    public function product_single($id) {
        $user_id = Get_id();
        // Find the product by its ID
        $product_tag = $this->product->where('id',$id)->with('tags')->first();
        $tags = $product_tag->tags->pluck('name');
        $rates = $this->rating->where('product_id',$id)->orderBy('created_at','desc')->paginate(5)->onEachSide(1);
        $all_rates = $this->rating->where('product_id',$id)->get();
        $rate_avg = rate_single_product($id);
        $product = $this->product->find($id);
        $variants = $this->variant->where('product_id', $id)->get();
        $attributes = $this->attribute->where('parent_id', 0)->get();
        $productImages = $this->productImage->where('product_id', $id)->get();
        $user_rated = $this->rating->where('product_id',$id)->where('user_id', $user_id)->first();
        $list_order_id = $this->order->where('user_id', $user_id)->pluck('id')->toArray();
        $user_order_detail = $this->order_detail->whereIn('order_id', $list_order_id)->where('product_id', $id)->first();
        $arr_wishlist = [];
        if(auth()->check()) {
            $wishlist = $this->wishList->where('user_id', auth()->user()->id)->get();
            $arr_wishlist = $wishlist->pluck('product_id')->toArray();
        }
        if($user_rated ){
            $check_rated = 1;
        }
        else if($user_order_detail){
            if(auth()->check()) {
                $check_rated = 0;
            }
            else {
                $check_rated = 1;
            }

        }
        else {
            $check_rated = 1;
        }
        $product_related = $this->product->where('id','!=',$id)->limit(4)->get();
        $chil_ids = [];
        $parent_ids = [];
        // Check if variants exist
        if ($variants->isNotEmpty()) {
            // Extract parent IDs from the first variant (assuming all variants have the same parent_ids)
            $parent_ids = explode(',', $variants[0]->parent_id);
            foreach ($variants as $item) {
                $ids = explode(',', $item->children_id);
                $chil_ids = array_merge($chil_ids, $ids);
            }
            $chil_ids = array_unique($chil_ids);
        }
        // Prepare data to pass to the view
        return view('home.product_single',[
            'product' => $product,
            'attributes' => $attributes,
            'variants' => $variants,
            'parent_ids' =>$parent_ids,
            'chil_ids' =>$chil_ids,
            'productImages' => $productImages,
            'tags' => $tags,
            'rates' => $rates,
            'rate_avg' => $rate_avg,
            'count_rate' => count($all_rates),
            'check_rated' => $check_rated,
            'product_related' => $product_related,
            'arr_wishlist' => $arr_wishlist


        ]);
    }

    public function variant_check(Request $request){
        $variantIds = $request->variantIds;
        $product_id = $request->product_id;
        $id_chil = implode(',',$variantIds);
        $variant = $this->variant->where('product_id',$product_id)->where('children_id',$id_chil)->first();

        return response()->json([
            'quantity' => $variant->quantity,
            'status' => true,
        ]);

    }
    public function add_rate(Request $request){
        $product_id = $request->product_id;
        $user_id = Get_id();

        $rated = $this->rating->where('product_id',$product_id)->where('user_id', $user_id)->first();
        if($rated){
            return redirect()->back()->with('error', 'Bạn Đã Đánh Giá Sản Phẩm Này Rồi');
        }

        $check = 0 ;
        $orders = $this->order->where('user_id',$user_id)->get();
        foreach ($orders as $key => $item){
            foreach ($item->order_detail as $val){
                if($val->product_id == $product_id){
                    $check = 1 ;
                    break;
                }

            }

        }
        $content = $request->content;
        if($content == null){
            return redirect()->back()->with('error', 'Bạn Chưa Nhập Nội Dung');
        }
        $rate = $request->rate;
        if($rate == null){
            return redirect()->back()->with('error', 'Bạn Chưa Chọn Xếp Hạng');
        }
        if($check == 1 ){
            $rating = $this->rating->create([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'rate' => $rate,
                'content' => $content,
            ]);
            if($rating)
            {
                return redirect()->back()->with('success', 'Đánh Giá Thành Công');

            }

        }

        return redirect()->back()->with('error', 'Không thể đánh giá khi mua hàng');


    }



  public function about(){

        return view('home.about');
    }

    public function service(){
        return view('home.service');
    }

    public function service_detail($id){

        return view('home.service_detail');
    }

    public function blog_detail($id){

        return view('home.blog_detail');
    }

    public function blog(){
        return view('home.blog');
    }

    public function contact(){
        return view('home.contact');
    }

    public function pricing_package(){
        return view('home.pricing_package');
    }

    public function history(){
        return view('home.history');
    }


}
