<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware para verificar los permisos del cliente antes de ejecutar una acción.
 */
class CheckClientPermissions
{
    /**
     * Maneja la solicitud HTTP antes de pasarla al siguiente middleware o controlador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Aquí va la lógica de validación de permisos
        if (! $request->user()->hasPermission('crear-cliente')) {
            return response()->json(['message' => 'No tienes permiso para realizar esta acción.'], 403);
        }

        return $next($request);
    }
}


