<?php

namespace App;
// use Storage;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id', 'img_src',
    ];

    public function user()
    {
        return $this->belongsTo('App\Product');
    }

    // public function getImg__srcAttribute($img_src)
    // {
    //     return asset(Storage::url($img_src));
    // }
}
