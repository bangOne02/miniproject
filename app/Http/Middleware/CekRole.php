<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $roles = $this->CekRoute($request->route());
        if ($request->user()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        return abort(404, 'NOT FOUND');
    }

    private function CekRoute($route)
    {
        $action = $route->getAction();
        return isset($action['roles']) ? $action['roles'] : null;
    }
}
