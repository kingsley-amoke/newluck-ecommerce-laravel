<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Spatie\Searchable\Search;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderBy('created_at', 'desc')->paginate(25);
        if(Auth::user()){

            $cart = Cart::where('user_id', Auth::user()->id)->get();
        }else{
            $cart = [];
        }


        if (request()->has('search')) {

            $products = Product::where('name', 'like', '%' . request()->get('search', '') . '%')
                ->orwhere('description', 'like', '%' . request()->get('search') . '%')
                ->orwhere('category', 'like', '%' . request()->get('search') . '%')
                ->paginate(25);
        }



        return view('products.index', ['products' => $products, 'cart' => $cart]);
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



        $reviews = Review::where('product_id', $id)->orderBy('created_at', 'desc')->paginate(5);

        $allReviews = Review::where('product_id', $id)->get();

        if (count($allReviews) > 0) {

            $total = 0;

            foreach ($allReviews as $review) {

                $total += $review->rating;
            }


            $averageRating = $total / count($allReviews);
        } else {
            $averageRating = 0;
        }

        $relatedProducts = Product::where('category', $product->category)->wherenot('name', $product->name)->paginate(4);



        return view('products.show', ['product' => $product, 'firstImage' => $firstImage, 'otherImages' => $otherImages, 'price' => $price, 'averageRating' => $averageRating, 'reviews' => $reviews, 'relatedProducts' => $relatedProducts]);
    }

    public function create()
    {

        if(!Auth::user()->admin){
            return redirect()->route('index');
        }

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

    //apis

    public function apiIndex(){
        return Product::paginate(1);
    }
}
