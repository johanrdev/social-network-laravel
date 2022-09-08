<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserCard extends Component
{
    public $user;
    public $showInfo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $showInfo)
    {
        $this->user = $user;
        $this->showInfo = $showInfo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-card');
    }
}
