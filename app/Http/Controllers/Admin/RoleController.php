<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('admin.roles.index', ['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
        ]);
        try{
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            $role->permissions()->attach($request->permissions);
            $role->save();
            toastr()->success('Role add successfully!', 'Success');
            return redirect()->back();
        }catch(\Exception $e){
            echo $e->getMessage();
            //toastr()->error("User don't add!", "Error" . $e->getMessage());
            //return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $role = Role::where(['slug' => $slug,'id' => $id])->firstOrFail();
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('admin.roles.edit')->with(['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       try{
           //dd($request->permissions);

            $role = Role::find($id);
            $role->name = $request->name;
            $role->update();
            $role->permissions()->detach();
            
            $role->permissions()->attach($request->permissions);
            $role->update();
            
            toastr()->success('Role update successfully!', 'Success');
            return redirect()->route('admin.role');
       }catch(\Exception $e){
           echo $e->getMessage();
            //toastr()->error("Role don't update", 'Error' . $e->getMessage());
            //return redirect()->back();
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $id = $request->id;
            $role = Role::where('id', $id)->first();
            $role->permissions()->detach($id);
            $role->delete();
        }catch(\Eexception $e){
            echo $e->getMessage();
        }
    }
}
