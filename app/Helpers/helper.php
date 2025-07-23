<?php

use App\Models\Setting;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Diglactic\Breadcrumbs\Breadcrumbs;
function Setting_key($config_key)
{
    $setting = Setting::where('config_key', $config_key)->first();
    if ($setting) {
        return $setting->config_value;
    }
    return '';
}

function Get_category($id)
{
    $category = Category::where('parent_id', $id)->get();
    if ($category) {
        return $category;
    }
    return '';
}



function Get_attribute($id)
{
    $attributes = Attribute::where('parent_id', $id)->get();
    $array = [];

    if ($attributes) {
        foreach ($attributes as $item) {
            $array[] = $item->name;
        }
        return implode(", ", $array);
    }
    return '';
}
function Get_attribute_home($id)
{
    $attribute = Attribute::where('parent_id', $id)->get();
    if ($attribute) {
        return $attribute;
    }
    return '';
}

function Get_attribute_parent($id, $parent_id = 0)
{
    $attribute = Attribute::where('id', $id)->where('parent_id', $parent_id)->first();
    if ($attribute) {
        return $attribute;
    }
    return null; // It's better to return null instead of an empty string
}

function get_attribute_name($string)
{
    $array = explode(',', $string);
    // Use a single query to get the names directly
    $name_array = Attribute::whereIn('id', $array)->pluck('name')->toArray();
    // Return the names as a comma-separated string
    return implode(", ", $name_array);
}

function Query_table($id, $table)
{
    $item = $table::find($id);
    if ($item) {
        return $item->name;
    }
}
function Carts()
{
    return session()->get('cart');
}


function Get_id()
{
    $user_id = auth()->id(); // Retrieve the authenticated user ID
    if ($user_id == null) {
        $user_id = session()->get('user_id');
        if ($user_id == null) {
            $user_id = rand(10000000, 99999999);
            // session()->put('user_id', $user_id);
            session(['user_id' => $user_id]);
            $user_id = session()->get('user_id');
        }
    }
    // dd($user_id);
    return $user_id;
}

function Get_cart()
{
    $user_id = Get_id();
    $carts = Cart::where('user_id', $user_id)->get();
    if (!$carts) {
        $carts = [];
    }
    return $carts;
}


function update_cart_logined($user_id)
{
    if ($user_id) {
        // Update user_id in cart table
        Cart::where('user_id', $user_id)->update(['user_id' => auth()->id()]);
        // Get all product IDs in cart
        $productIds = Cart::where('user_id', auth()->id())->pluck('product_id')->all();
        // Find duplicate product IDs
        $duplicates = collect($productIds)->duplicates();
        // Process each duplicate product ID
        foreach ($duplicates as $productId) {
            // Get all cart items for this product ID
            $cartItems = Cart::where('user_id', auth()->id())->where('product_id', $productId)->get();
            // Calculate total quantity for this product ID
            $totalQuantity = $cartItems->sum('quantity');
            // Delete duplicate cart items
            $cartItems->slice(1)->each(function ($cartItem) {
                $cartItem->delete();
            });
            // Update remaining cart item with total quantity
            $cartItems->first()->update(['quantity' => $totalQuantity]);
        }
    }
}



function Api_Rate_USD()
{
    // Replace with your actual API key from ExchangeRate-API
    $apiKey = '7638d5f115b43d006a9ff88e';
    $apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/latest/USD";
    $response = file_get_contents($apiUrl);

    if ($response === FALSE) {
        die('Error occurred while fetching exchange rates.');
    }

    $data = json_decode($response, true);
    if (isset($data['conversion_rates']['VND'])) {
        $usdToVndRate = $data['conversion_rates']['VND'];
    }
    return $usdToVndRate;
}


function RandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


function Array_ids($id)
{
    $record = Variant::find($id);
    if (!$record) {
        return ''; // Or handle the error as needed
    }
    $listIds = $record->children_id;
    $arr = explode(',', $listIds);
    $array = [];
    foreach ($arr as $item) {
        $item = trim($item);
        $attribute = Attribute::find($item);
        if ($attribute) {
            $array[] = $attribute->name;
        }
    }
    return implode(",", $array);
}



function getFirstNumber($string)
{
    // Split the string by commas
    $parts = explode(',', $string);
    // Return the first element of the array
    return $parts[0];
}
function removeFirstNumber($string)
{
    $numbers = explode(',', $string);
    $numbers = array_map('trim', $numbers);
    $firstNumber = array_shift($numbers);
    $remainingNumbers = implode(',', $numbers);

    return $remainingNumbers;
}

function getPriceProduct($id, $attr = 0)
{
    $product = Product::find($id);
    if ($attr == 0) {
        $price = $product->price;
    } else {
        $variant = Variant::where('product_id', $id)->where('children_id', $attr)->first();
        $price = $variant->price ?? $product->price;
    }
    return $price;
}

function Get_total_moth($year)
{
    $orders = DB::table(DB::raw('(SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS m'))
        ->leftJoin('orders', function ($join) use ($year) {
            $join->on(DB::raw('MONTH(orders.created_at)'), '=', 'm.month')
                ->whereYear('orders.created_at', '=', $year);
        })
        ->selectRaw("count(id) AS sodon,$year AS year, m.month AS month, COALESCE(SUM(orders.total_price), 0) AS total_amount")
        ->groupBy('m.month')
        ->orderBy('m.month')
        ->get();

    //DB::raw('(SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5
    // UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT
    // 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS m'):
    //Tạo một bảng tạm thời m chứa các giá trị từ 1 đến 12, đại diện cho các tháng trong năm.

    // /leftJoin('orders', function($join) use ($year) {...}): Thực hiện một LEFT JOIN giữa bảng tạm thời m và bảng orders.
    //  DB::raw('MONTH(orders.created_at)'): Lấy tháng từ cột created_at của bảng orders.
    //  whereYear('orders.created_at', '=', $year): Chỉ lấy các đơn hàng trong năm được chỉ định (được truyền vào biến $year).


    // selectRaw(...): Chọn các cột cụ thể từ kết quả truy vấn.
    // $year AS year: Trả về năm được truyền vào.
    //  m.month AS month: Trả về tháng từ bảng tạm thời m.
    //  COALESCE(SUM(orders.total_price), 0) AS total_amount:
    // Tính tổng số tiền (total_price) của các đơn hàng cho mỗi tháng.
    // Nếu không có đơn hàng nào trong tháng đó, giá trị sẽ là 0 (sử dụng COALESCE để thay thế giá trị NULL bằng 0).

    //groupBy('m.month'): Nhóm kết quả theo tháng.
    //orderBy('m.month'): Sắp xếp kết quả theo tháng theo thứ tự tăng dần.

    return $orders;
}
function isAllZeros($array)
{
    if (array_sum($array) == 0) {
        return  false;
    }
    return  true;
}


function rate_star($val)
{
    if ($val > 0) {
        if ($val == 1) {
            return '★';
        } else if ($val == 2) {
            return '★★';
        } else if ($val == 3) {
            return '★★★';
        } else if ($val == 4) {
            return '★★★★';
        } else {
            return '★★★★★';
        }
    }
}

function get_name_user()
{
    if (auth()->check()) {
        return auth()->user()->name;
    }
}


function Get_breadcrumb()
{
    $route = \Route::current();
    if ($route) {
        $routeName = $route->getName();
        if ($routeName) {
            $parameters = array_values($route->parameters());
            $breadcrumbs = Breadcrumbs::generate($routeName, ...$parameters);
            return $breadcrumbs ??  [];
        }
    }
}


function getColorCSS($colorName) {
    // Define an associative array of color mappings
    $colors = array(
        // Common English color names
        'red' => 'color: red;',
        'blue' => 'color: blue;',
        'green' => 'color: green;',
        'yellow' => 'color: yellow;',
        'purple' => 'color: purple;',
        'orange' => 'color: orange;',
        'cyan' => 'color: cyan;',
        'magenta' => 'color: magenta;',
        'brown' => 'color: brown;',
        'teal' => 'color: teal;',
        'pink' => 'color: pink;',
        'lime' => 'color: lime;',
        'silver' => 'color: silver;',
        'gold' => 'color: gold;',
        'maroon' => 'color: maroon;',
        'navy' => 'color: navy;',
        'olive' => 'color: olive;',
        'indigo' => 'color: indigo;',
        'azure' => 'color: azure;',
        // Vietnamese color names
        'đỏ' => 'color: red;', // Đỏ means 'red'
        'xanh' => 'color: green;', // Xanh means 'green'
        'xanh dương' => 'color: blue;', // Xanh dương means 'blue'
        'vàng' => 'color: yellow;', // Vàng means 'yellow'
        'tím' => 'color: purple;', // Tím means 'purple'
        'cam' => 'color: orange;', // Cam means 'orange'
        'xanh lá cây' => 'color: green;', // Xanh lá cây means 'green'
        'xanh nước biển' => 'color: cyan;', // Xanh nước biển means 'cyan'
        'hồng' => 'color: pink;', // Hồng means 'pink'
        'vàng chanh' => 'color: lime;', // Vàng chanh means 'lime'
        'bạc' => 'color: silver;', // Bạc means 'silver'
        'vàng ròng' => 'color: gold;', // Vàng ròng means 'gold'
        'nâu' => 'color: brown;', // Nâu means 'brown'
        'xanh dương nhạt' => 'color: lightblue;', // Xanh dương nhạt means 'light blue'
        'xám' => 'color: gray;', // Xám means 'gray'
        'đen' => 'color: black;', // Đen means 'black'
    );
        $colorNameLower = mb_strtolower($colorName, 'UTF-8'); // Use mb_strtolower for UTF-8 support

        // Check if the color exists in the $colors array
        if (array_key_exists($colorNameLower, $colors)) {
            return $colors[$colorNameLower];
        } else {
            return ''; // Default behavior, or handle unknown colors as needed
        }
    }


 function total_quantity($id){
    $variant = Variant::where('product_id',$id)->get();
    $total = 0;
    if($variant){
        foreach ($variant as $item){
            $total += $item->quantity;
        }
    }
    return $total;

 }

 function avg_rate($rate_arrs){
    $sum = 0;
    foreach($rate_arrs as $key =>$item){
        $sum += $item->rate;
        $avg = $key;
    }
    return round($sum/($avg + 1),0);
 }


function rate_single_product($id){
    $all_rates = Rating::where('product_id',$id)->get();
    if(count($all_rates)>0){
        $rate_avg = avg_rate($all_rates);

    }
    else {
        $rate_avg = 0;
    }
    return $rate_avg;
}


function convert_vi_to_en($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
    $str = preg_replace("/(đ)/", "d", $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
    $str = preg_replace("/(Đ)/", "D", $str);
    //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
    return str_replace(' ', '', $str);;
}

function list_attr_name(){
    $list = [];
    $attributes = Attribute::where('parent_id', 0)->get();
    foreach ($attributes as $item){
        $list[] = convert_vi_to_en($item->name);
    }
    return $list;
}

function categories_arr($category){
    $arr_category = [];
    if($category > 0 ){
        $arr_category[]  = $category;
        $chil_categories = Get_category($category);
        foreach ($chil_categories as $val ){
            $arr_category[] = $val->id;
        }
    }
    return $arr_category;
}

function count_product_category($category){
    $arr_category = categories_arr($category);
    $product = Product::whereIn('category_id',$arr_category)->get();

    return count($product);

}
function filter_product($list, $query= '',$category = 0){
    $arr_category = categories_arr($category);
    $max = isset(request()->max) ? intval(request()->max) : 50000000;
    $min = isset(request()->min) ? intval(request()->min) : 0;
    $orderby = isset(request()->orderby) ? request()->orderby : 'news';

    if ($orderby == 'news') {
        $orderby = 'desc';
        $order_name = 'created_at';
    } elseif ($orderby == 'hot') {
        $orderby = 'desc';
        $order_name = 'view';
    } elseif ($orderby == 'price_up') {
        $orderby = 'asc';
        $order_name = 'price';
    } elseif ($orderby == 'price_down') {
        $orderby = 'desc';
        $order_name = 'price';
    }
    $arr_products = [];
    foreach ($list as $item){
        $items = $item.'s';
        $items = isset(request()->$items) ? request()->$items : null;
        if($items) {
            $arrs = explode(',',$items);
            foreach ($arrs as $val){
                $filters = Variant::whereRaw("FIND_IN_SET(?, children_id)", [$val])->get();
                foreach ($filters as $key => $filter){
                    $arr_products[] = $filter->product_id;
                }

            }
        }
    }

    if(count($arr_products)>0){
        $filter_product = (array_unique($arr_products));
        if(count($arr_category)>0){
            $products = Product::whereIn('id', $filter_product)
            ->where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->whereIn('category_id',$arr_category)
            ->orderBy($order_name, $orderby)
            ->paginate(9)
            ->onEachSide(1);
        }
        else if($query != ''){
            $products = Product::whereIn('id', $filter_product)
            ->where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->where('name', 'LIKE', '%'.$query.'%')
            ->orderBy($order_name, $orderby)
            ->paginate(9)
            ->onEachSide(1);
        }
        else {
            $products = Product::whereIn('id', $filter_product)
            ->where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->orderBy($order_name, $orderby)
            ->paginate(9)
            ->onEachSide(1);
        }


    }
    else {
        if(count($arr_category)>0){
            $products = Product::where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->whereIn('category_id',$arr_category)
            ->orderBy($order_name, $orderby)
            ->paginate(9)
            ->onEachSide(1);
        }
        else if($query != ''){
            $products = Product::where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->orderBy($order_name, $orderby)
            ->where('name', 'LIKE', '%'.$query.'%')
            ->paginate(9)
            ->onEachSide(1);
        }
        else {
            $products = Product::where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->orderBy($order_name, $orderby)
            ->paginate(9)
            ->onEachSide(1);
        }

    }
    return $products;
}



