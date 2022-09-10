<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserCard extends Component
{
    public $user;
    public $showInfo;
    public $showDescription;
    public $showFullDescription;
    public $showFriendRequestLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $showInfo = true, $showDescription = true, $showFullDescription = true, $showFriendRequestLink = true)
    {
        $this->user = $user;
        $this->showInfo = $showInfo;
        $this->showDescription = $showDescription;
        $this->showFullDescription = $showFullDescription;
        $this->showFriendRequestLink = $showFriendRequestLink;
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
