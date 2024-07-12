<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getRouteKeyName(){
        return 'slug';
    }
    public function index(){

        $categories = Category::all();

        $products = Product::all();
        
        return view('index', ['categories' => $categories, 'products' => $products]);
    }

    public function show($id){

        $category = Category::findorFail($id);
       
        $products = Product::where('category', $category->name)->get();
 

        return view('categories.show', ['products' => $products]);
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $category = new Category();

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->image = 'images/'.$imageName;

        $category->save();

        return redirect('/')->with('success', 'Category created successfully');

    }


}
