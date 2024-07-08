<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\HttpService;

class ClientController extends Controller
{
    protected $httpService;

    /**
     * Constructor para ClientController.
     * 
     * @param HttpService $httpService Servicio HTTP para realizar peticiones externas.
     */
    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    /**
     * Método index.
     * Retorna todos los clientes registrados.
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Método store.
     * Valida y guarda un nuevo cliente.
     * 
     * @param Request $request Petición HTTP con los datos del cliente a guardar.
     * @return Client Cliente creado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_razon_social' => 'required|string',
            'rut' => 'required|string|unique:clients,rut',
            'telefono' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'direccion_casa_matriz' => 'required|string',
            'tipo' => 'required|in:empresa,persona',
        ]);

        return Client::create($request->all());
    }

    /**
     * Método show.
     * Muestra un cliente específico por su ID.
     * 
     * @param int $id ID del cliente a mostrar.
     * @return Client Cliente encontrado.
     */
    public function show($id)
    {
        return Client::findOrFail($id);
    }

    /**
     * Método update.
     * Actualiza un cliente existente por su ID.
     * 
     * @param Request $request Petición HTTP con los datos actualizados del cliente.
     * @param int $id ID del cliente a actualizar.
     * @return Client Cliente actualizado.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'nombre_razon_social' => 'required|string',
            'rut' => 'required|string|unique:clients,rut,' . $client->id,
            'telefono' => 'required|string',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'direccion_casa_matriz' => 'required|string',
            'tipo' => 'required|in:empresa,persona',
        ]);

        $client->update($request->all());

        return $client;
    }

    /**
     * Método destroy.
     * Elimina un cliente por su ID.
     * 
     * @param int $id ID del cliente a eliminar.
     * @return \Illuminate\Http\JsonResponse Mensaje de éxito.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente']);
    }

    /**
     * Método authenticate.
     * Autentica al usuario con el sistema externo y devuelve un token de acceso.
     * 
     * @param Request $request Petición HTTP con rut y contraseña del usuario.
     * @return \Illuminate\Http\JsonResponse Token de acceso o mensaje de error.
     */
    public function authenticate(Request $request)
    {
        $rut = $request->input('rut');
        $password = $request->input('password');
        
        $authResponse = $this->httpService->authenticate($rut, $password);
        
        if ($authResponse && isset($authResponse['access_token'])) {
            $token = $authResponse['access_token'];
            // Almacenar token o realizar acciones posteriores
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    }

    /**
     * Método getPermissions.
     * Obtiene los permisos del usuario desde el sistema externo.
     * 
     * @param Request $request Petición HTTP con token de autorización y ID de usuario.
     * @param int $userId ID del usuario del cual se obtienen los permisos.
     * @return \Illuminate\Http\JsonResponse Permisos del usuario o mensaje de error.
     */
    public function getPermissions(Request $request, $userId)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['error' => 'No autorizado'], 401);
        }
        
        $permissions = $this->httpService->getUserPermissions($token, $userId);
        
        if ($permissions) {
            return response()->json($permissions);
        } else {
            return response()->json(['error' => 'Permisos no encontrados'], 404);
        }
    }
}

