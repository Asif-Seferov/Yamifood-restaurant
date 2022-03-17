<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Permission extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name', 'slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function setNameAttribute($name){
        $this->attributes['name'] = ucfirst($name);
    }

    public function getDate($date){
        return Carbon::parse($date)->diffForHumans(Carbon::now());
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
