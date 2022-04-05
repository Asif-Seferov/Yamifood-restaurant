<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(){
        return view('admin.menus.index');
    }
    public function store(Request $request){
        $request->validate([
            'menu' => 'required',
        ]);
        try{
            $menu = new Menu();
            $menu->name = $request->menu;
            $menu->save();
            toastr()->success('Menu create successfully!', 'Success');
            return redirect()->back();
        }catch(\Exception $e){
            toastr()->error("Menu don't create successfully!", 'Error' . $e->getMessage());
            return redirect()->back();
        }
    }
}
