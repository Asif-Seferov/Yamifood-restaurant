<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // List users 
    public function index(){
        $users = User::orderBy('id', 'DESC')->get();
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
           }catch(exception $e){
                toastr()->error("User don't add!", "Error" . getMessage()->$e);
                return redirect()->back();
           }  
       
    }

}
