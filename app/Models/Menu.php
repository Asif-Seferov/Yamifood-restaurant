<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Menu extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name', 'slug', 'status', 'list'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function setNameAttribute($name){
        return $this->attributes['name'] = ucfirst($name);
    }
}
