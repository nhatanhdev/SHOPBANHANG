<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Role;
use DB;
use App\Models\Permission;
class RoleController extends Controller
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
    public function index(){
        $roles = $this->role->all();
        return view('admin.role.index',compact('roles'));
    }
    public function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add',[
            'permissionsParent' => $permissionsParent
        ]);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $role= $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name,

            ]);
            $role->permissions()->attach($request->permission_id);

            DB::commit();
            return redirect()->route('admin.role.index')->with('success', 'Thêm quyền thành công!');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error',$exception->getMessage());

        }

    }
    public function edit($id){
        $role = $this->role->find($id);
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        $permissionsChecked = $role->permissions;
        return view('admin.role.edit',[
            'role' => $role,
            'permissionsParent' => $permissionsParent,
            'permissionsChecked' => $permissionsChecked
        ]);
    }
    public function update(Request $request, $id){
        try{
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role->permissions()->sync($request->permission_id);

            DB::commit();
            return redirect()->route('admin.role.index')->with('success', 'Cập nhật quyền thành công!');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function destroy($id){
        try{
            $role = $this->role->find($id);
            $role->delete();
            return response()->json([
                'message'=> 'Xóa Thành Công!',
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
            $roles = Role::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%');

            })->get();
            return view('admin.role.index',[
                'roles' => $roles
            ]);
        }
    }


}
