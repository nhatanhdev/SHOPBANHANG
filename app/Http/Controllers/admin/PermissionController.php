<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Role;
use DB;
use App\Models\Permission;

class PermissionController extends Controller
{
    private $permission;
    private $user;
    private $str;
    private $role;
    public function __construct(User $user,Str $str,Role $role,Permission $permission){
        $this->user = $user;
        $this->str = $str;
        $this->role = $role;
        $this->permission = $permission;
    }
    function index(){
        $permissions = $this->permission->where('parent_id',0)->get();
        return view('admin.permission.index',[
            'permissions' => $permissions
        ]);
    }
    function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();

        return view('admin.permission.add',[
            'permissionsParent' => $permissionsParent
        ]);
    }

    function store(Request $request){
        $permission = $this->permission ->create([
            'name' => $request->name_module,
            'display_name' => $request->name_module,
            'parent_id' => 0
        ]);
        foreach($request->actions as $action){
            $this->permission ->create([
                'name' => $action,
                'display_name' => $action,
                'parent_id' => $permission->id,
                'key_code' => $request->name_module . '_' . $action
            ]);
        }
        return redirect()->route('admin.permission.index');
    }

    // function edit($id){
    //     $permission = $this->permission->find($id);
    //     $permissionsParent = $permission->where('parent_id',0)->get();
    //     $permissionsChecked = $permission->permissions;

    //     return view('admin.permission.edit',[
    //         'permission' => $permission,
    //         'permissionsParent' => $permissionsParent,
    //     ]);
    // }

    function destroy($id){

        try {
            $permission = $this->permission->find($id)->delete();
            $permission_chil = $this->permission->where('parent_id',$id)->delete();
            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true

            ]);

        }
        catch(\Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage(),
                'status' => false

            ]);
        }

    }

    public function search(Request $request){
        $q = $request->q;
        if ($q) {
            $permissions = Permission::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');
            })->where('parent_id',0)->get();
            return view('admin.permission.index',[
                'permissions' => $permissions
            ]);
        }
    }
}
