<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    public function index(){
        $sliders = $this->slider->all();
        return view('admin.slider.index',[
            'sliders' => $sliders

        ]);
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(Request $request){
        $data_upload_slider = $this->storageTraitUpload($request,'image','slider');

        $data = [
            'title' => $request->title,
            'url' => $request->url,
        ];

        if(!empty($data_upload_slider)){
            $data['image'] = $data_upload_slider['file_path'];
        }
        $this->slider->create($data);
        return redirect()->route('admin.slider.index');
    }
    public function edit($id){

        $slider = $this->slider->find($id);
        return view('admin.slider.edit',[
            'slider' => $slider
        ]);
    }
    public function update(Request $request, $id){
        try{
            $data_update_slider = $this->storageTraitUpload($request,'image','slider');
            $data = [
                'title' => $request->title,
                'url' => $request->url,
            ];
            if(!empty($data_update_slider)){
                $data['image'] = $data_update_slider['file_path'];
            }
            $slider = $this->slider->find($id);
            $slider->update($data);
            return redirect()->route('admin.slider.index')->with('success', 'Cập nhật thành công!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function destroy($id){
        try{
            $slider = $this->slider->find($id);
            $slider->delete();
            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=> $e->getMessage(),
                'status' => false
            ]);
        }

    }

    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $sliders = Slider::where(function($query) use ($q) {
                $query->where('title', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.slider.index',[
                'sliders' => $sliders
            ]);
        }
    }
}
