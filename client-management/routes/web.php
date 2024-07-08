<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;

// Rutas generadas por Auth::routes()
Auth::routes();

// Ruta para cargar la vista principal de Vue.js
Route::get('/dashboard', function () {
    return view('dashboard'); // Aquí 'dashboard' es el nombre de la vista de Vue.js
})->middleware('auth');

// Ruta para cargar la vista de clientes (lista de clientes)
Route::get('/clients', function () {
    return view('clients'); // Aquí 'clients' es el nombre de la vista de Vue.js
})->middleware('auth');

// Ruta para cargar la vista de detalles de un cliente específico
Route::get('/clients/{id}', function () {
    return view('client-details'); // Aquí 'client-details' es el nombre de la vista de Vue.js
})->middleware('auth');

// Rutas para autenticación y permisos
Route::post('authenticate', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get('clients/{user}/permissions', [ClientController::class, 'getPermissions']);

    // Rutas para ClientController con middleware 'client-permissions'
    Route::middleware('client-permissions')->group(function () {
        Route::get('/api/clients', [ClientController::class, 'index']);
        Route::post('/api/clients', [ClientController::class, 'store']);
        Route::get('/api/clients/{id}', [ClientController::class, 'show']);
        Route::put('/api/clients/{id}', [ClientController::class, 'update']);
        Route::delete('/api/clients/{id}', [ClientController::class, 'destroy']);
    });
});

// Ruta para cualquier otra solicitud que cargue la vista de Vue.js
Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*')->middleware('auth');









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
