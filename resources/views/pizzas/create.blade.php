@extends('layout.layout')

@section('content')
<div class="w-full bg-slate-300 border-b-slate-600 text-black">
    <h3>Order a pizza</h3>
    <div>
        <form action="/pizzas" method="POST" class="text-black flex flex-col gap-5">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <label for="type">Type</label>
            <select name="type" id="type">
                <option value="nigerian">Nigerian</option>
                <option value="korean">Korean</option>
                <option value="japanese">Japanese</option>
            </select>
            <label for="base">Base</label>
            <select name="base" id="base">
                <option value="plantain">Plantain</option>
                <option value="beef">Beef</option>
                <option value="chicken">Chicken</option>
            </select>
            <fieldset class=" text-white">
                <label for="toppings">Extra toppings</label><br/>
                <input type="checkbox" name="toppings[]" id="toppings" value="mushroom">Mushroom <br />
                <input type="checkbox" name="toppings[]" id="toppings" value="veggies">Veggies <br />
                <input type="checkbox" name="toppings[]" id="toppings" value="coconut">Coconut <br />
                <input type="checkbox" name="toppings[]" id="toppings" value="candy">Candy <br />
            </fieldset>
            <input type="submit" value="Add Pizza" class="text-white">
        </form>
    </div>
</div>
@endsection