<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Product;
use Storage;

class ImagesController extends Controller
{
    public function add(Request $request) {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        if(!$product_id){
            return "product not found";
        }
        if ($request->hasFile('image')) {
            $image = Image::create([
                'product_id' => $product_id,
                'img_src' =>$request->file('image')->store('public/images')
            ]);
            $image->img_src = asset(Storage::url($image->img_src));
            return $image;
        }
        return "please select an image to upload";
    }

    public function update(Request $request, $id) {
        $image = Image::find($id);
        if($image){
            $image->img_src = $request->file('image')->store('public/images');
            return "uploaded successfully";
        }
        return "could not found";
    }

    public function delete(Request $request, $id) {
        $image = Image::find($id);
        if($image){
            $image->delete();
            // unlink the image from disk ?
            return "deleted successfully";
        }
        return "could not found";
    }
}
