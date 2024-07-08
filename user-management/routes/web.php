<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\AuthController;

// Rutas para la API de UserController
Route::prefix('api')->group(function () {
    Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
    Route::get('/users/{user}', [UserController::class, 'show']); // Mostrar un usuario específico
    Route::get('/users/{user}/permissions', [UserController::class, 'permissions']); // Obtener permisos de un usuario específico

    // Rutas para la gestión de permisos
    Route::get('/permissions', [PermissionController::class, 'index']); // Obtener todos los permisos
    Route::post('/permissions', [PermissionController::class, 'store']); // Crear un nuevo permiso
    Route::put('/permissions/{permission}', [PermissionController::class, 'update']); // Actualizar un permiso existente
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy']); // Eliminar un permiso

    // Rutas de autenticación
    Route::post('login', [AuthController::class, 'login']); // Iniciar sesión
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']); // Cerrar sesión
        Route::get('user', [AuthController::class, 'user']); // Obtener información del usuario autenticado
    });
});

// Rutas existentes (para usuarios web)
Route::get('/users', [Controller::class, 'index']); // Obtener todos los usuarios
Route::post('/users', [Controller::class, 'store']); // Crear un nuevo usuario
Route::get('/users/{id}', [Controller::class, 'show']); // Mostrar un usuario específico
Route::put('/users/{id}', [Controller::class, 'update']); // Actualizar un usuario existente
Route::delete('/users/{id}', [Controller::class, 'destroy']); // Eliminar un usuario

// Rutas de autenticación generadas por Auth::routes()
Auth::routes();

// Ruta home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

