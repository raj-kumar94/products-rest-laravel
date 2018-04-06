<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $with = ['images'];
    protected $fillable = [
        'name', 'price', 'qty','description','image_src',
    ];

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
