<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();




        return view('products.index', ['products' => $products]);
    }

    public function show($id)
    {

        $product = Product::findorFail($id);

        $productImage = ProductImage::where('product_id', $id)->get();
        if (count($productImage) > 0) {

            $firstImage = $productImage[0]->image;
        } else {
            $firstImage = '';
        }

        $otherImages = [];

        for ($i = 1; $i < count($productImage); $i++) {
            array_push($otherImages, $productImage[$i]);
        }

        $price = Number::currency($product->price, 'NGN');



        $reviews = Review::where('product_id', $id)->get();

        if (count($reviews) > 0) {

            $total = 0;

            foreach ($reviews as $review) {

                $total += $review->rating;
            }


            $averageRating = $total / count($reviews);
        } else {
            $averageRating = 0;
        }




        return view('products.show', ['product' => $product, 'firstImage' => $firstImage, 'otherImages' => $otherImages, 'price' => $price, 'averageRating' => $averageRating, 'reviews' => $reviews]);
    }

    public function create()
    {

        $categories = Category::all();

        return view('products.create', ['categories' => $categories]);
    }



    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $product->save();



        return redirect()->action([ProductImageController::class, 'index'], ['productId' => $product->id])->with('success', 'Please add images for this product');
    }
}
