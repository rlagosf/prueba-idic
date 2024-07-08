<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User; // Importa el modelo User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Mostrar una lista de los recursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all()); // Retorna todos los usuarios en formato JSON
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user); // Retorna los datos del usuario específico en formato JSON
    }

    /**
     * Obtener los permisos del usuario.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function permissions(User $user)
    {
        // Aquí puedes implementar lógica para obtener y retornar los permisos del usuario
        return response()->json([
            'user' => $user, // Retorna los datos del usuario
            'permissions' => $user->permissions()->get(), // Asume que tienes una relación definida en tu modelo User
        ]);
    }
}



