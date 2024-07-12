<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{

    public function index()
    {

       $pizzas = Pizza::all();

        return view('pizzas.index', [
            'pizzas' => $pizzas
        ]);
    }

    public function show($id)
    {

        $pizza = Pizza::findorFail($id);

        return view('pizzas.show', ['pizza' => $pizza]);
    }

    public function create(){


        return view('pizzas.create');
    }

    public function store(){

        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');

        $pizza->save();

        return redirect('/')->with('message', 'Thanks for your order');
    }
}
