<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;


class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::orderBy('id', 'DESC')->paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }
    public function store(Request $request){
        $this->authorize('create', Permission::class);
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);
        try{
            Permission::create(['name' => $request->name]);
            toastr()->success('Permission add successfully!', 'Success');
            return redirect()->back();
        }catch(\Exception $e){
            toastr()->error("Permission don't add!", 'Error' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($slug, $id){
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', ['permission' => $permission]);
    }
    public function update(Request $request, Permission $permission, $id){

        $this->authorize('update', $permission);
        // if (! Gate::allows('isAdmin')) {
        //     abort(403);
        // }
        try{
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->update();
            toastr()->success('Permission update successfully!', 'Success');
            return redirect()->route('admin.permission');
        }catch(\Exception $e){
            toastr()->error("Permission don't update!", 'Error' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function destroy(Permission $permission, Request $request){
       
        try{
            $id = $request->id;
            $permission = Permission::where('id', $id)->first();
            $this->authorize('delete', $permission);
            $permission->delete();
            
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}
