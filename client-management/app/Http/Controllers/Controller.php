<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Clase base para controladores en Laravel.
 * 
 * Esta clase extiende BaseController de Laravel y utiliza traits para
 * autorización y validación de peticiones.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

