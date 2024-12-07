<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permisos)
    {
        $userPermissions = Session::get('permisos', []);

        $userPermissions = array_map('strtolower', $userPermissions);
        $permisos = array_map('strtolower', $permisos);

        foreach ($permisos as $permiso) {
            if (in_array($permiso, $userPermissions)) {
                return $next($request);
            }
        }
        return redirect('NoAutorizado')->with('error', 'No tienes acceso a esta página.');
    }
}
