<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use Storage;

class ProductsController extends Controller
{

    // add a product
    public function add(Request $request){

        $img_src = '';
        if ($request->hasFile('image')) {
            // store image to storage
            $img_src = $request->file('image')->store('public/images');
        }

        if(!$request->name){
            return 'product name is required';
        }

        if(!$request->price){
            return 'price is required'; 
        }

        $qty = 0;
        if($request->qty){
            $qty = $request->qty;
        }

        $description = '';
        if($request->description){
            $description = $request->description;
        }
        
        $product = Product::create([
            'name' => $request->name,
            'description' => $description,
            'price' => $request->price,
            'qty' =>$qty,
            'image_src' => $img_src
        ]);

        // if ($request->hasFile('image1')) {
        //     $image = Image::create([
        //         'product_id' => $product->id,
        //         'img_src' =>$request->file('image1')->store('public/images')
        //     ]);
        // }
        
        return $product;
    }


    //update a single product
    public function update(Request $request, $id){
        $product = Product::find($id);
        // dd($product);
        if($product){
            if($request->description){
                $product->description = $request->description;
            }
            if($request->name){
                $product->name = $request->name;
            }
            if($request->qty){
                $product->qty = $request->qty;
            }
            if($request->price){
                $product->price = $request->price;
            }
            if ($request->hasFile('image')) {
                $img_src = $request->file('image')->store('public/images');
                $product->image_src = $img_src;
            }

            return $product->save() ? 'product updated!' : 'could not update the product';
        }else{
            return 'product not found';
        }
        
    }

    // Delete a single product
    public function delete(Request $request, $id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return 'product deleted';
        }

        return 'cannot delete the product';
    }

    
    // List all products
    public function listAll(Request $request){
        $products =  Product::paginate(10);
        foreach($products as $product){
            $product->image_src = asset(Storage::url($product->image_src));
            foreach($product->images as $p_img){
                $p_img->img_src = asset(Storage::url($p_img->img_src));
            }
        }
        return $products;
    }

    // view a single product
    public function viewProduct(Request $request, $id){
        $product = Product::find($id);
        if($product){
            $product->image_src = asset(Storage::url($product->image_src));
        }
        return $product;
    }

    // view Images
    public function viewImage(Request $request, $id){
        $image = Image::all();
        
        foreach($image as $key => $p) {
            $p->img_src = asset(Storage::url($p->img_src));
        }
        return $image;
        // return asset(Storage::url($image->img_src));
    }

}
