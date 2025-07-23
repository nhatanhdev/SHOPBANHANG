<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Role;
use DB;
use App\Http\Requests\UserAdmin;
use App\Traits\StorageImageTrait;

class UserController extends Controller
{
    use StorageImageTrait;
    private $user;
    private $str;
    private $role;
    public function __construct(User $user,Str $str,Role $role){
        $this->user = $user;
        $this->str = $str;
        $this->role = $role;
    }
    public function index(){
        $users = $this->user->all();
        return view('admin.user.index',[
            'users' => $users]);

    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.user.add',[
            'roles' => $roles,
        ]);
    }
    public function store(UserAdmin $request){
        try{
            DB::beginTransaction();
            $data_upload_avatar = $this->storageTraitUpload($request,'avatar','avatar');
            $new_user =  [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];
            if(!empty($data_upload_avatar)){
                $new_user['avatar'] = $data_upload_avatar['file_path'];
            }
            $user = $this->user->create($new_user);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'Thêm user thành công!');

        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function edit($id){
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $rolesofuser = $user->roles;

        return view('admin.user.edit',[
            'roles' => $roles,
            'user' => $user,
            'rolesofuser' => $rolesofuser,
        ]);
    }
    public function update(Request $request,$id){
        try{

            DB::beginTransaction();
            $user = $this->user->find($id);
            $data_upload_avatar = $this->storageTraitUpload($request,'avatar','avatar');
            $password =  bcrypt($request->password);
            $query = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            if(!empty($request->password)){
                $query['password'] = $password;
            }
            if(!empty($data_upload_avatar)){
                $query['avatar'] = $data_upload_avatar['file_path'];
            }
            $user_update = $user->update($query);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'Cập nhật thành công!');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
    public function destroy($id){

        try{
            $user = $this->user->find($id);
            $user->delete();
            return response()->json([
                'message'=> 'Xóa thành công!',
                'status' => true

            ]);        }
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
            $users = User::where(function($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                      ->orWhere('id', 'like', '%'.$q.'%')
                      ->orWhere('email', 'like', '%'.$q.'%');

            })->get();
            return view('admin.user.index',[
                'users' => $users
            ]);
        }
    }

}
