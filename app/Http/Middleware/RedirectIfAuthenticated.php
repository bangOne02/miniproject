<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $roleId = (Int) $user->role_id;
                switch ($roleId){
                    case 1:
                        return redirect()->intended(RouteServiceProvider::AUDIT);
                    case 2:
                        return redirect()->intended(RouteServiceProvider::ADMIN);
                    case 3:
                        return redirect()->intended(RouteServiceProvider::PENDAFTARAN);
                    case 4:
                        return redirect()->intended(RouteServiceProvider::DOKTER);
                    case 5:
                        return redirect()->intended(RouteServiceProvider::APOTIK);
                    case 6:
                        return redirect()->intended(RouteServiceProvider::USER);
                    default:
                        abort('404','NOT FOUND');
                }
            }
        }

        return $next($request);
    }
}
