<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function index($productId){

        if(!Auth::user()->admin){
            return redirect()->route('index');
        }
        $product = Product::findOrFail($productId);
        
        $productImages = ProductImage::where('product_id',$productId)->get();
        return view('product-image.index', compact('product','productImages'));
    }

    public function store(Request $request, int $productId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        $product = Product::findOrFail($productId);

        $imageData = [];

        if($files = $request->file('images')){

            foreach($files as $key => $file){

                $extension = $file->getClientOriginalExtension();
                $filename = $key.'-'.time(). '.' .$extension;

                $path = "images/products/";

                $file->move($path, $filename);

                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path.$filename,
                ];
            }
        }

        ProductImage::insert($imageData);

        return redirect()->back()->with('status', 'Uploaded Successfully');
}

public function apiStore(Request $request)
{
    // $request->validate([
    //     'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
    // ]);


    // $imageData = [];

    // if($files = $request->file('images')){

    //     foreach($files as $key => $file){

    //         $extension = $file->getClientOriginalExtension();
    //         $filename = $key.'-'.time(). '.' .$extension;

    //         $path = "images/test/";

    //         $file->move($path, $filename);

    //         $imageData[] = [
                
    //             'image' => $path.$filename,
    //         ];
    //     }
    // }


    return ['gt'=>'t'];
}

public function destroy(int $productImageId)
    {
        $productImage = ProductImage::findOrFail($productImageId);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();

        return redirect()->back()->with('status', 'Image Deleted');
    }

}