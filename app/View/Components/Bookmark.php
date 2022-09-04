<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Bookmark extends Component
{
    public $bookmark;
    public $id;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bookmark, $id, $type)
    {
        $this->bookmark = $bookmark;
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bookmark');
    }
}
