<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryOption extends Component
{
    public $category;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.category-option');
    }
}
