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
        // Obtener los permisos del usuario desde la sesión
        $userPermissions = Session::get('permisos', []);

        // Verificar si el usuario tiene el permiso necesario
        if (!in_array($requiredPermission, $userPermissions)) {
            // Si no tiene el permiso, redirigir a una página de error o login
            return redirect('NoAutorizado')->with('error', 'No tienes acceso a esta página.');
        }

        // Si tiene el permiso, continuar con la solicitud
        return $next($request);
    }
}
