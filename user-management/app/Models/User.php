<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens; // Importa el trait de Passport para tokens API

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Utiliza los traits necesarios

    /**
     * La clave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'rut';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apellido', 'rut', 'email', 'password',
    ];
    
    /**
     * Define la relación de muchos a muchos con los permisos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    
    // Puedes añadir otras relaciones y lógica de modelo aquí...
}

