<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $sections;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sections)
    {
        $this->sections = $sections;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
