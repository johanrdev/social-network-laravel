<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListContainer extends Component
{
    public $title;
    public $source;
    public $paginate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $source, $paginate = true)
    {
        $this->title = $title;
        $this->source = $source;
        $this->paginate = $paginate;
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
