<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::orderBy('list', 'ASC')->paginate(10);
        return view('admin.menus.index')->with('menus', $menus);
    }
    public function menu_list(){
       try{
             foreach($_POST['item'] as $key => $value){
                $menus = Menu::find(intval($value));
                $menus->list = intval($key+1);
                $menus->save();
             }
         }catch(\Exception $e){
            echo $e->getMessage();
         } 
    }
    public function store(Request $request){
        $request->validate([
            'menu' => 'required',
        ]);
        try{
            $menu = new Menu();
            $menu->name = $request->menu;
            if($request->status != null){
                $menu->status = $request->status;
            }
            $menu->save();
            toastr()->success('Menu create successfully!', 'Success');
            return redirect()->back();
        }catch(\Exception $e){
            toastr()->error("Menu don't create successfully!", 'Error' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit($id){
        $menu = Menu::where('id', $id)->firstOrFail();
        return view('admin.menus.edit', compact('menu'));
    }
    public function update(Request $request, $id){
        try{
            $menu = Menu::find($id);
            $menu->name = $request->menu;
            $menu->status = $request->status;
            $menu->update();
            toastr()->success('Menu updated successfully!', 'Success');
            return redirect()->route('admin.menu');
        }catch(\Exception $e){
            toastr()->error("Menu don't updated successfully", 'Error' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function destroy(Request $request){
        try{
            $id = $request->id;
            $delete = Menu::where('id', $id)->first();
            $delete->delete();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    // For Template
    public function menu(){
        $menus = Menu::all();
        return view('template.layouts.header', compact('menus'));
    }
}
