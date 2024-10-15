<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredPermission)
    {

        $userPermissions = Session::get('permisos', []);

        if (!in_array($requiredPermission, $userPermissions)) {
            return redirect('NoAutorizado')->with('error', 'No tienes acceso a esta página.');
        }

        return $next($request);
    }
}
