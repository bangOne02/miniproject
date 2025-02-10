<?php

namespace App\Http\Controllers\Apotik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        return view('apotik.dashboard', array(
            'title' => "Dashboard Administrator | MyKlinik v.1.0",
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ));
    }
}
