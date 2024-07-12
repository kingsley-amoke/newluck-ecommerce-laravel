<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class product extends Component
{
    /**
     * Create a new component instance.
     */

     protected $name;
     protected $image;
     protected $quantity;
     protected $price;
     protected $id;
     protected $category;

    public function __construct($name, $image, $quantity, $price, $id, $category)
    {
        $this->name = $name;
        $this->image = $image;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->id = $id;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product');
    }
}
