<?php

namespace App\View\Components\Admint;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLayoutAdmin extends Component
{

    public $firstMenu;
    public $secondMenu;

    public function __construct($firstMenu,$secondMenu)
    {
        $this->firstMenu = $firstMenu;
        $this->secondMenu = $secondMenu;
    }

    public function render(): View|Closure|string
    {
        return view('components.admint.sidebar-layout-admin');
    }
}
