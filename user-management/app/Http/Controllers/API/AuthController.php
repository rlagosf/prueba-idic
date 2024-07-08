<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para manejar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->only('rut', 'password'); // Obtener credenciales del request

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Obtener el usuario autenticado
            $token = $user->createToken('LaravelAuthApp')->accessToken; // Crear y obtener token de acceso

            return response()->json(['token' => $token], 200); // Respuesta con el token
        } else {
            return response()->json(['error' => 'Unauthorized'], 401); // Respuesta de error si no está autorizado
        }
    }

    // Método para cerrar sesión
    public function logout(Request $request)
    {
        $request->user()->token()->revoke(); // Revocar el token del usuario

        return response()->json(['message' => 'Successfully logged out']); // Confirmación de cierre de sesión
    }

    // Método para obtener información del usuario autenticado
    public function user(Request $request)
    {
        return response()->json($request->user()); // Retorna los datos del usuario en formato JSON
    }
}

