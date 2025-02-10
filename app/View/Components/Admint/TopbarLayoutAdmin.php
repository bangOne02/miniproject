<?php

namespace App\View\Components\Admint;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopbarLayoutAdmin extends Component
{

    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.admint.topbar-layout-admin');
    }
}
