<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;
use Illuminate\Support\Str;
class CategoryController extends Controller

{   private $category;
    private $str;
    public function __construct(Category $category , Str $str){
        $this->category = $category;
        $this->str = $str;
    }
    public function getCategory($parent_id = ''){

        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }
    public function create(){

        $htmlOption = $this->getCategory();

        return view('admin.category.add' ,([
            'htmlOption' => $htmlOption]));

    }

    public function store(Request $request){
        $query = $this->category->create([
            'name' => $request->name_category,
            'parent_id' => $request->parent_id,
            'slug' => $this->str->slug($request->name_category)
        ]);
        if($query){
            return redirect()->route('admin.category.index')->with('success', 'Thêm thành công!');
        }
        else {
            return redirect()->back()->with('error', 'Xảy ra lỗi!');
        }

    }

    public function index(){
        return view('admin.category.index',([
            'categories' => $this->category->all()
        ]));
    }

    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);

        return view('admin.category.edit',([
            'category' => $category,
            'htmlOption' => $htmlOption
        ]));
    }

    public function update($id,Request $request){
        try
        {
            $category = $this->category->find($id);
            $query = $category->update([
                'name' => $request->name_category,
                'parent_id' => $request->parent_id,
                'slug' => $this->str->slug($request->name_category)
            ]);
            if($query){
                return redirect()->route('admin.category.index')->with('success', 'Cập nhật thành công!');
            }
        }

        catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function destroy($id){
        $category = $this->category->find($id);
        $query = $category->delete();
        if($query){
            return redirect()->route('admin.category.index')->with('success', 'Xóa thành công!');
        }

        else {
            return redirect()->back()->with('error', 'Xảy ra lỗi!');
        }

    }

    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $categories = Category::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.category.index',[
                'categories' => $categories
            ]);
        }
    }
}
