<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
    public function create(){
        return view('admin.users.create');
    }
    // Store Users
    public function store(UserRequest $request){
        
           try{
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
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
        return view('admin.users.edit', compact('user'));
    }
    // Update Users
    public function update(Request $request, $id){
        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();
            toastr()->success('User update successfully!', 'Success');
            return redirect()->route('admin.user');
        }catch(\Exception $e){
            toastr()->error("User don't updated!", "Error" . $e->getMessage());
            return redirect()->back();
        }
    }
    // Delete Users
     public function destroy(Request $request){
        try{
            $userId = $request->data;
            $delete = User::find($userId);
            $delete->delete();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    } 

}
