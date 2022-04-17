<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    } 

    public function create(){
        return view('admin.sliders.create');
    }
    public function store(Request $request){
        try{
            $data = $request->all();
            $data['slider_image'] = Slider::uploadImage($request);
            $slider = new Slider();
            $slider->slider_img = $data['slider_image'];
            $slider->slider_title = $data['slider_title'];
            $slider->slider_description = $data['slider_description'];
            $slider->slider_status = $data['status_slider'];
            $slider->slider_btn_text = $data['slider_btn_text'];
            $slider->slider_btn_color = $data['slider_btn_color'];
            $slider->slider_btn_status =  ($data['slider_btn_status'] === "on") ? 'active' : 'passive';
            $slider->save();
            toastr()->success('Slider add successfully', 'Success');
            return redirect()->route('admin.slider');
        }catch(\Exception $e){
             toastr()->error("Slider don't add successfully");
            return redirect()->back();
        }
    }
    public function edit($id){
            $slider = Slider::findOrFail($id);
            return view('admin.sliders.edit', compact('slider'));
    }
     public function update(Request $request, $id){
         try{
                
                $data = $request->all();
                $slider = Slider::find($id);
                $data['slider_image'] = Slider::uploadImage($request, $slider->slider_img);
                if($request->hasFile('slider_image')){
                    $slider->slider_img = $data['slider_image'];
                }
                $slider->slider_title = $data['slider_title'];
                $slider->slider_description = $data['slider_description'];
                $slider->slider_status = $data['status_slider'];
                $slider->slider_btn_text = $data['slider_btn_text'];
                $slider->slider_btn_color = $data['slider_btn_color'];
                $slider->slider_btn_status =  ($data['slider_btn_status'] === "on") ? 'active' : 'passive';
                $slider->update();
                toastr()->success('Slider update successfully', 'Success');
                return redirect()->route('admin.slider');
            }catch(\Exception $e){
                echo $e->getMessage();
                /* toastr()->error("Slider don't update successfully", "Error" . $e->getMessage());
                return redirect()->back(); */
            } 
    } 
    public function destroy(Request $request){
        try{
            $id = $request->id;
            $slider = Slider::where('id', $id)->first();
            Storage::delete($slider->slider_img);
            $slider->delete();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}
