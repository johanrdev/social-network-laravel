<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListContainer extends Component
{
    public $title;
    public $source;
    public $paginate;
    public $scrollY;
    public $maxHeight;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $source, $paginate = true, $scrollY = true, $maxHeight = 'max-h-80')
    {
        $this->title = $title;
        $this->source = $source;
        $this->paginate = $paginate;
        $this->scrollY = $scrollY;
        $this->maxHeight = $maxHeight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-container');
    }
}
