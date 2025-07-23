<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Components\Recusive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Traits\StorageImageTrait;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Http\Requests\ProductAdd;
use App\Models\Variant;
use App\Models\Inventory;
class ProductController extends Controller
{
    use StorageImageTrait;
    private $inventory;

    private $category;
    private $str;
    private $product;
    private $tag;
    private $productTag;
    private $productImage;
    private $attribute;
    private $variant;
    public function __construct(Category $category , Str $str, Product $product, Tag $tag, ProductTag $productTag, ProductImage $productImage,Attribute $attribute,Variant $variant,Inventory $inventory){
        $this->category = $category;
        $this->str = $str;
        $this->product = $product;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productImage = $productImage;
        $this->attribute = $attribute;
        $this->variant= $variant;
        $this->inventory= $inventory;

    }
    public function getCategory($parent_id = ''){

        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }

    // public function getAtrribute($parent_id = ''){
    //     $data = $this->attribute->all();
    //     $recusive = new Recusive($data);
    //     $htmlAttrs = $recusive->categoryRecusive($parent_id);
    //     return $htmlAttrs;
    // }



    public function index()
    {

        return view('admin.product.index' , [
            'products' => $this->product->all()
        ]);

    }

    public function create(){
        $Attributes = $this->attribute->where('parent_id', 0)->get();
        $htmlOption = $this->getCategory();
        return view('admin.product.add' ,([
            'htmlOption' => $htmlOption,
            'Attributes' => $Attributes
        ]));


    }
    public function store(Request $request){
        try{
            DB::beginTransaction();

            $data_upload_feature_image = $this->storageTraitUpload($request,'feature_image','products');

            $new_product =  [
                'name' => $request->name,
                'price' => $request->price,
                'price_old' => $request->price_old,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ];
            if(!empty($data_upload_feature_image)){
                $new_product['feature_image'] = $data_upload_feature_image['file_path'];
                $new_product['feature_image_name'] = $data_upload_feature_image['file_name'];

            }
            $product_created = $this->product->create($new_product);
            $total_quantity = 0;
            if($request->has('attrs') && $request->has('variants_status')){
                foreach($request->variants_status as $key => $status){
                    $new_variants = [
                        'parent_id' => implode(",", $request->attrs),
                        'children_id' => $request->variants_children[$key],
                        'price' => $request->variants_price[$key],
                        'price_old' => $request->variants_price_old[$key],
                        'quantity' => $status,
                    ];
                    $total_quantity = $total_quantity + $status;
                    if($request->hasFile("variants_image_gallery.$key")){
                        $image_variants = $this->storageTraitUploadMutiple($request->file("variants_image_gallery.$key"), 'variants_product');
                        $new_variants['detail_image'] = $image_variants['file_path'];
                    }
                    $product_created->variants()->create($new_variants);
                }
            }



            if($request->hasFile('detail_image')){
                foreach($request->detail_image as $detail_image){
                    $data_upload_detail_image = $this->storageTraitUploadMutiple($detail_image,'products');
                    $new_image_product = $product_created->images()->create([
                        'image_path' => $data_upload_detail_image['file_path'],
                        'file_name' => $data_upload_detail_image['file_name'],
                    ]);


                }
            }
            $tag_ids = [];
            if(!empty($request->tags)){
                foreach($request->tags as $tagName) {
                    $newTag = $this->tag->firstOrcreate([
                        'name' => $tagName,
                    ]);
                    $tag_ids[] = $newTag->id;

                }
                $tags_product = $product_created->tags()->attach($tag_ids);

            }

            $create_invetory = $product_created->inventories()->create([
                'price_wholesale' => 0,
                'quantity' => 0,
                'product_name' => $product_created->name,
            ]);

            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Thêm sản phẩm thành công!');


        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }

    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            $product = $this->product->find($id)->delete();
            $productImage = $this->productImage->where('product_id',$id)->delete();
            DB::commit();
            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true
            ]);

        }
        catch(\Exception $exception){
            DB::rollBack();

            return response()->json([
                'message'=> $exception->getMessage(),
                'status' => false

            ]);
        }
    }

    public function edit($id){
        $product = $this->product->find($id);
        $Attributes = $this->attribute->where('parent_id', 0)->get();

        $Variant = $this->variant->where('product_id',$id)->first();
        if($Variant){
            $str = $Variant->parent_id;

        }
        else {
            $str = '';
        }
        $array_parent = explode(',', $str);
        $htmlOption = $this->getCategory($product->category_id);


        return view('admin.product.edit',[
            'product' => $product,
            'htmlOption' => $htmlOption,
            'Attributes' => $Attributes,
            'array_parent' => $array_parent,
            'id' => $id,
        ]);
    }
    public function update(Request $request, $id){

        try{
            DB::beginTransaction();
            $data_update_products = $this->storageTraitUpload($request,'feature_image','products');
            $new_product =  [
                'name' => $request->name,
                'price' => $request->price,
                'price_old' => $request->price_old,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ];
            if(!empty($data_update_products)){
                $new_product['feature_image'] = $data_update_products['file_path'];
                $new_product['file_name'] = $data_update_products['file_name'];

            }

            $product_created = $this->product->find($id);
            $product_created->update($new_product);

            if ($request->has('attrs') && $request->has('variants_status')) {
                $this->variant->where('product_id', $id)->delete();
                // Loop through each variant from the request
                foreach ($request->variants_status as $key => $status) {
                    // Initialize new variant data
                    $new_variants = [
                        'parent_id' => implode(",", $request->attrs),
                        'children_id' => $request->variants_children[$key],
                        'price' => $request->variants_price[$key],
                        'price_old' => $request->variants_price_old[$key],
                        'quantity' => $status,
                    ];

                    // Check if a file was uploaded for the variant
                    if($request->hasFile("variants_image_gallery.$key")){
                        $image_variants = $this->storageTraitUploadMutiple($request->file("variants_image_gallery.$key"), 'variants_product');
                        $new_variants['detail_image'] = $image_variants['file_path'];
                    }
                    else {
                        $new_variants['detail_image'] = $request->images[$key];
                    }
                    // Create the variant associated with the product
                    $product_created->variants()->create($new_variants);
                }
            }


            if($request->hasFile('detail_image')){
                $this->productImage->where('product_id', $id)->delete();
                foreach($request->detail_image as $detail_image){
                    $data_upload_detail_image = $this->storageTraitUploadMutiple($detail_image,'products');
                    $new_image_product = $product_created->images()->create([
                        'image_path' => $data_upload_detail_image['file_path'],
                        'file_name' => $data_upload_detail_image['file_name'],
                    ]);


                }
            }
            $tag_ids = [];
            if(!empty($request->tags)){

                foreach($request->tags as $tagName) {
                    $newTag = $this->tag->firstOrcreate([
                        'name' => $tagName,
                    ]);
                    $tag_ids[] = $newTag->id;

                }
                $tags_product = $product_created->tags()->sync($tag_ids);

            }
            $update_inventory = $product_created->inventories()->update([
                'product_name' => $product_created->name,
            ]);

            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Cập nhật sản phẩm thành công!');

        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());

        }

    }


    public function Html_options(Request $request){
        $id = $request->id;
        $product_id = $request->product_id;
        $Variants = $this->variant->where('product_id',$product_id)->get();
        $chil_ids = [];
        foreach ($Variants as $item) {
            $ids = explode(',', $item->children_id);
            $chil_ids = array_merge($chil_ids, $ids);
        }
        $chil_ids = array_unique($chil_ids);

        $items = [];
        if($id){
            foreach ($id as $parent_id) {
                $attributes = Attribute::where('parent_id', $parent_id)->get();
                $name_parent = Attribute::Where('id', $parent_id)->first();
                if ($attributes->count() > 0) {
                    $itemData = [
                        'name' => $name_parent->name,  // Replace with actual name from parent if needed
                        'id_parent' => $parent_id,
                        'attributes' => $attributes
                    ];
                    $items[] = $itemData;
                }
            }
        }
        return response()->json(['items' => $items,'chil_ids' =>$chil_ids,'Variants' =>$Variants]);

    }

    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $products = $this->product::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.product.index',[
                'products' => $products
            ]);
        }
    }





}
