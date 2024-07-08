<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Servicio para interactuar con APIs HTTP externas.
 */
class HttpService
{
    protected $client;
    
    /**
     * Constructor que inicializa el cliente HTTP.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('USER_MANAGEMENT_API_URL', 'http://ruta-a-tu-user-management-api/'),
            'timeout'  => 2.0,
        ]);
    }
    
    /**
     * Realiza la autenticación del usuario en la API externa.
     *
     * @param  string  $rut
     * @param  string  $password
     * @return array|null
     */
    public function authenticate($rut, $password)
    {
        try {
            $response = $this->client->post('api/login', [
                'form_params' => [
                    'rut' => $rut,
                    'password' => $password,
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Manejo de errores
            return null;
        }
    }
    
    /**
     * Obtiene los permisos del usuario desde la API externa.
     *
     * @param  string  $token
     * @param  int  $userId
     * @return array|null
     */
    public function getUserPermissions($token, $userId)
    {
        try {
            $response = $this->client->get("api/users/{$userId}/permissions", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Manejo de errores
            return null;
        }
    }
    
    // Otros métodos para interactuar con la API de user-management...
}
