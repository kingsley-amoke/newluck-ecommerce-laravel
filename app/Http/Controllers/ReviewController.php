<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(int $productId, Request $request)
    {

        $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);


        $product = Product::findOrFail($productId);

        $reviews = new Review();

        $reviews->rating = $request->rating;
        $reviews->review = $request->review;
        $reviews->product_id = $product->id;

        $reviews->save();

        return redirect()->back()->with('status', 'Review submitted successfully');
    }
}
