<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function getRouteKeyName(){
        return 'slug';
    }
    public function index(){

        $categories = Category::all();

        $products = Product::all();

        if(Auth::user()){

            $cart = Cart::where('user_id', Auth::user()->id)->get();
        }else{
            $cart = [];
        }
        
        return view('index', ['categories' => $categories, 'products' => $products, 'cart' => $cart]);
    }

    public function show($id){

        $category = Category::findorFail($id);
       
        $products = Product::where('category', $category->name)->orderBy('created_at', 'desc')->paginate(25);
 

        return view('categories.show', ['products' => $products, 'category' => $category]);
    }

    public function create(){

        if(!Auth::user()->admin){
            return redirect()->route('index');
        }
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
        $category->parent_id = $request->parent_id;

        $category->save();

        return redirect('/')->with('success', 'Category created successfully');

    }


}
