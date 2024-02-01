<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    protected $hash;
    protected $messages;
    protected $response;
    protected $clientModel;

    public function __construct(Hash $hash, Client $clientModel, Response $response)
    {
        $this->hash = $hash;
        $this->response = $response;
        $this->clientModel = $clientModel;
        $this->messages['client_uuid'] = [];
    }

    public function index()
    {

        try {

            $client = $this->clientModel->get();

            return response()->json([
                'data' => $client,
            ], status: $this->response::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ClientRequest $request)
    {

        try {

            $client = $this->clientModel->make($request->all());
            $client->password = $this->hash::make($request->password);
            $client->save();

            return response()->json([
                'data' => $client->makeHidden(['uuid']),
            ], status: $this->response::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($client_uuid)
    {

        try {

            $user = $this->clientModel->find($client_uuid);

            if (!$user) {

                array_push($this->messages['client_uuid'], 'Client tidak ditemukan!');

                return response()->json([
                    'message' => $this->messages,
                ], status: $this->response::HTTP_BAD_REQUEST);
            } else {

                return response()->json([
                    'data' => $user,
                ], status: $this->response::HTTP_OK);
            }
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ClientRequest $request, $client_uuid)
    {

        try {

            $client = $this->clientModel->find($client_uuid);

            if (!$client) {

                array_push($this->messages['client_uuid'], 'Client tidak ditemukan!');

                return response()->json([
                    'message' => $this->messages,
                ], status: $this->response::HTTP_BAD_REQUEST);
            } else {

                $request->merge([
                    'identifier' => $request->identifier ?? $client->identifier,
                    'password' => $request->password ? $this->hash::make($request->password) : $client->password,
                    'slug' => null,
                ]);

                $client->update($request->all());

                return response()->json([
                    'data' => $client->makeHidden(['uuid']),
                ], status: $this->response::HTTP_OK);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($client_uuid)
    {

        try {

            $client = $this->clientModel->find($client_uuid);

            if (!$client) {

                array_push($this->messages['client_uuid'], 'Client tidak ditemukan!');

                return response()->json([
                    'message' => $this->messages,
                ], status: $this->response::HTTP_BAD_REQUEST);
            } else {

                $client->delete();

                array_push($this->messages['client_uuid'], 'Client berhasil dihapus!');

                return response()->json([
                    'message' => $this->messages,
                ], status: $this->response::HTTP_OK);
            }
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], status: $this->response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
