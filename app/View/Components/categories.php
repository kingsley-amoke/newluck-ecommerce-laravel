<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class categories extends Component
{
    /**
     * Create a new component instance.
     */

     protected $name;
     protected $slug;
     protected $image;

    public function __construct($name, $slug, $image)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories');
    }
}
