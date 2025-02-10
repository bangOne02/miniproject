<?php

namespace App\View\Components\admint;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorMessageComponent extends Component
{

    public function __construct()
    {
        //
    }

    
    public function render(): View|Closure|string
    {
        return view('components.admint.error-message-component');
    }
}
