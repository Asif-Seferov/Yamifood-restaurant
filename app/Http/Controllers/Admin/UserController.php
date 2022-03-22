<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    // List users 
    public function index(){
        if(Cache::has('users')){
            $users = Cache::get('users');
        }else{
            $users = User::orderBy('id', 'DESC')->paginate(10);
            Cache::put('users', $users, 1);
        }
        return view('admin.users.index', compact('users'));
    }
    // Create user
    public function create(Request $request){
        if($request->ajax()){
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;
            return $permissions;
        }


        $roles = Role::all();
        return view('admin.users.create', ['roles' => $roles]);
    }
    // Store Users
    public function store(UserRequest $request){
        
           try{
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                if($request->role != null){
                    $user->roles()->attach($request->role);
                    $user->save();
                }

                if($request->permissions != null){
                    foreach($request->permissions as $permission){
                        $user->permissions()->attach($permission);
                         $user->save();
                    } 
                }
                toastr()->success('User add successfully!', 'Success');
                return redirect()->route('admin.user');
           }catch(\Exception $e){
                toastr()->error("User don't add!", "Error" . $e->getMessage());
                return redirect()->back();
           }  
       
    }
    // Edit Users
    public function edit($id){
        $user = User::where('id', $id)->firstOrFail();
        $roles = Role::get();
        $userRole = $user->roles->first();
        if($userRole != null){
            $rolePermissions = $userRole->allRolePermissions;
        }else{
            $rolePermissions = null;
        }
        
        $userPermissions = $user->permissions;
       
        return view('admin.users.edit', compact(['user', 'roles', 'userRole', 'rolePermissions', 'userPermissions']));
    }
    // Update Users
    public function update(Request $request, $id){
        
        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();

            $user->roles()->detach();
            $user->permissions()->detach();

            if($request->role != null){
                $user->roles()->attach($request->role);
                $user->save();
            }
            if($request->permissions != null){
                foreach($request->permissions as $permission){
                    $user->permissions()->attach($permission);
                    $user->save();
                }
            }
            toastr()->success('User update successfully!', 'Success');
            return redirect()->route('admin.user');
        }catch(\Exception $e){
            echo $e->getMessage();
            //toastr()->error("User don't updated!", "Error" . $e->getMessage());
            //return redirect()->back();
        }
    }
    // Delete Users
     public function destroy(Request $request){
        try{
            
            $userId = $request->data;
            $delete = User::find($userId);
            $delete->roles()->detach();
            $delete->permissions()->detach();
            $delete->delete();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    } 

}
