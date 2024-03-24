<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ClientResource;
use App\Contracts\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientRepository implements ClientRepositoryInterface
{
    private $client;
    private $response;

    public function __construct(Client $client, JsonResponse $response)
    {
        $this->client = $client;
        $this->response = $response;
    }

    public function all(): JsonResponse
    {
        try {
            $client = $this->client->latest()->get();

            $resource = ClientResource::collection($client);

            return new $this->response($resource, $this->response::HTTP_OK);
        } catch (\Throwable) {
            throw new HttpException($this->response::HTTP_INTERNAL_SERVER_ERROR, 'Error server internal');
        }
    }

    public function save($request): JsonResponse
    {

        try {
            $client = new $this->client;

            $client->identifier = $request->identifier;
            $client->password = $request->password;

            $client->save();

            $resource = new ClientResource($client);

            return new $this->response($resource, $this->response::HTTP_CREATED);
        } catch (\Throwable) {
            throw new HttpException($this->response::HTTP_INTERNAL_SERVER_ERROR, 'Error server internal');
        }
    }

    public function show($uuid): JsonResponse
    {
        try {
            $client = $this->client->findOrFail($uuid);

            $resource = new ClientResource($client);

            return new $this->response($resource, $this->response::HTTP_OK);
        } catch (ModelNotFoundException) {
            throw new HttpException($this->response::HTTP_NOT_FOUND, 'Client tidak ditemukan');
        } catch (\Throwable) {
            throw new HttpException($this->response::HTTP_INTERNAL_SERVER_ERROR, 'Error server internal');
        }
    }

    public function update($request, $uuid): JsonResponse
    {

        try {
            $client = $this->client->findOrFail($uuid);

            $client->identifier = $request->identifier;
            $client->password = $request->password;

            $client->update();

            $resource = new ClientResource($client);

            return new $this->response($resource, $this->response::HTTP_CREATED);
        } catch (ModelNotFoundException) {
            throw new HttpException($this->response::HTTP_NOT_FOUND, 'Client tidak ditemukan');
        } catch (\Throwable) {
            throw new HttpException($this->response::HTTP_INTERNAL_SERVER_ERROR, 'Error server internal');
        }
    }

    public function delete($uuid): JsonResponse
    {

        try {
            $client = $this->client->findOrFail($uuid);

            $client->delete();

            return new $this->response(true, $this->response::HTTP_OK);
        } catch (ModelNotFoundException) {
            throw new HttpException($this->response::HTTP_NOT_FOUND, 'Client tidak ditemukan');
        } catch (\Throwable) {
            throw new HttpException($this->response::HTTP_INTERNAL_SERVER_ERROR, 'Error server internal');
        }
    }
}
