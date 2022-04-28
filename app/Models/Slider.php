<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['slider_img', 'slider_title', 'slider_description', 'slider_status', 'slider_btn_text', 'slider_btn_color', 'slider_btn_status'];
    public static function uploadImage(Request $request, $img = null){
        if($request->hasFile('slider_image')){
            if($img){
                Storage::delete($img);
            }
            $folder = date('Y-m-d');
            return $request->file('slider_image')->store($folder);
        }
        return null;
    }
    public function setNameAttribute($name){
        return $this->attributes['name'] = ucfirst($name);
    }
    public function getImage($img){
        if($img){
            return asset("uploads/{$img}");
        }
        return null;
    }
    public function getDate($date){
        return Carbon::parse($date)->diffForHumans(Carbon::now());
    }
}
