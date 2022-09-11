<?php

namespace App\View\Components\Friends;

use Illuminate\View\Component;

class Request extends Component
{
    public $from;
    public $to;
    public $request;
    public $canAccept;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($from, $to, $request, $canAccept = true)
    {
        $this->from = $from;
        $this->to = $to;
        $this->request = $request;
        $this->canAccept = $canAccept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.friends.request');
    }
}
