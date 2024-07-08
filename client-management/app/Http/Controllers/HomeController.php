<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para la página de inicio de la aplicación.
 * 
 * Este controlador maneja la autenticación del usuario y muestra el dashboard de la aplicación.
 */
class HomeController extends Controller
{
    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Middleware para requerir autenticación
    }

    /**
     * Muestra el dashboard de la aplicación.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home'); // Retorna la vista 'home' que muestra el dashboard
    }
}
