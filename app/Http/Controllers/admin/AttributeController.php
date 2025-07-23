<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Components\Recusive;
use Illuminate\Support\Str;
class AttributeController extends Controller
{
    private $attribute;
    public function __construct(Attribute $attribute,Str $str){
        $this->attribute = $attribute;
        $this->str = $str;
    }

    public function getCategory($parent_id = ''){

        $data = $this->attribute->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }
    public function index(){
        $attributes = $this->attribute->where('parent_id', 0)->get();
        return view('admin.attribute.index',
            [
                'attributes' => $attributes,
            ]);
    }

    public function create(){
        return response()->json([
            'status' => true,
        ]);
    }
    public function store(Request $request){
        $new_attribute = $this->attribute->create([
            'name' => $request->name_attribute,
            'rank' => $request->rank ?? 0 ,
            'parent_id' =>$request->parent_id ?? 0
        ]);
        if($new_attribute){
            return redirect()->route('admin.attribute.index')->with('success', 'Thêm thành công!');
        }
        else {
            return redirect()->back()->with('error', 'Xảy ra lỗi!');
        }
    }
    public function edit($id){
        $attribute = $this->attribute->find($id);
        $chil_attributes = $this->attribute->where('parent_id', $id)->orderBy('rank', 'ASC')->get();
        return view('admin.attribute.edit',[
            'attribute' => $attribute,
            'chil_attributes' => $chil_attributes,
        ]);
    }

    public function edit1($id){
        $attribute = $this->attribute->find($id);
        $modal_edit = view('admin.attribute.edit1', [
            'attribute' => $attribute,
        ])->render();
        return response()->json([
            'status' => true,
            'modal_edit' => $modal_edit

        ]);
    }
    public function update(Request $request,$id){
        $attribute = $this->attribute->find($id);
        $rank = $request->rank;
        if(!$rank){
            $rank = 0;
        }
        $query = $attribute->update([
            'name' => $request->name_attribute,
            'rank' => $rank,
        ]);
        if($query){
            if($rank == 0){
                return redirect()->route('admin.attribute.index')->with('success', 'Cập nhật thành công!');
            }
            return redirect()->back()->with('success', 'Cập nhật thành công!');

        }
        else {
            return redirect()->back()->with('error', 'Xảy ra lỗi!');
        }
    }
    public function destroy($id){
        $attribute = $this->attribute->find($id);
        $query = $attribute->delete();
        if($query){
            return redirect()->back()->with('success', 'Xóa thành công!');
        }
        else {
            return redirect()->back()->with('error', 'Xảy ra lỗi!');
        }
    }

    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $attributes = Attribute::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.attribute.index',[
                'attributes' => $attributes
            ]);
        }
    }





}
