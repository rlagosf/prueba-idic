<?php
// app/Models/Client.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Modelo para la entidad Cliente.
 */
class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_razon_social', 'rut', 'telefono', 'email', 'direccion_casa_matriz', 'tipo', 'password',
    ];

    /**
     * Los atributos que deben estar ocultos para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retorna los tipos de clientes disponibles.
     *
     * @return array
     */
    public static function tipos()
    {
        return [
            'empresa' => 'Empresa',
            'persona' => 'Persona Natural',
        ];
    }
}


