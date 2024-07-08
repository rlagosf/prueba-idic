<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Los mapeos de políticas para la aplicación.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', // Mapeos de políticas, actualmente no definidos
    ];

    /**
     * Registra los servicios de autenticación/autorización.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies(); // Registra las políticas definidas

        Passport::routes(); // Registra las rutas proporcionadas por Passport para la autenticación API
    }
}

