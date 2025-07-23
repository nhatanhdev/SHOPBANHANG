<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    private $setting;
    public function __construct(Setting $setting){
        $this->setting = $setting;

    }
    public function index(){
        $settings = $this->setting->all();
        return view('admin.setting.index',[
            'settings' => $settings
        ]);
    }

    public function create(){

        return view('admin.setting.add');
    }

    public function store(Request $request){
       try {
        $data =[
          'config_key' => $request->config_key,
          'config_value' => $request->config_value
        ];
        $this->setting->create($data);
        return redirect()->route('admin.setting.index')->with('success','Thêm cài đặt thành công');
       }
       catch (\Exception $exception){
        return redirect()->back()->with('error',$exception->getMessage());
       }
    }

    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit',[
            'setting' => $setting
        ]);
    }

    public function update(Request $request, $id){
        try {
            $data =[
                'config_key' => $request->config_key,
                'config_value' => $request->config_value
            ];
            $this->setting->find($id)->update($data);
            return redirect()->route('admin.setting.index')->with('success','Cập nhật thành công');
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function destroy($id){
        try {
            $this->setting->find($id)->delete();
            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true
            ]);
        }
        catch (\Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage(),
                'status' => false
            ]);
        }
    }



    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $settings = Setting::where(function($query) use ($q) {
                $query->where('config_key', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->get();
            return view('admin.setting.index',[
                'settings' => $settings
            ]);
        }
    }
}
