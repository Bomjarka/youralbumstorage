<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class BlockedLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('layouts.userblocked');
    }
}
