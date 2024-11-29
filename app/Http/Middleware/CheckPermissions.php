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
    public function handle(Request $request, Closure $next, $permisos)
    {
        $userPermissions = array_map('strtolower', Session::get('permisos', []));
        $requiredPermissions = array_map('strtolower', explode(',', $permisos));

        if (array_intersect($requiredPermissions, $userPermissions)) {
            return $next($request); // Tiene permisos, continuar
        }

        // Si no tiene permisos, redirigir a la página de acceso denegado
        return redirect('NoAutorizado')->with('error', 'No tienes acceso a esta página.');
    }
}
