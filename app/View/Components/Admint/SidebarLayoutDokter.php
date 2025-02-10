<?php

namespace App\View\Components\Admint;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLayoutDokter extends Component
{
    public string $firstMenu;
    public string $secondMenu;
    public function __construct(string $firstMenu, string $secondMenu)
    {
        $this->firstMenu = $firstMenu;
        $this->secondMenu = $secondMenu;
    }

    public function render(): View|Closure|string
    {
        return view('components.admint.sidebar-layout-dokter');
    }
}
