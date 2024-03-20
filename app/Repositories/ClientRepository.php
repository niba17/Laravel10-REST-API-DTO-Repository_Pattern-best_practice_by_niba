<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use App\Contracts\ClientServiceInterface;
use App\Http\Resources\ClientResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientRepository implements ClientServiceInterface
{
    private $client;
    private $res;

    public function __construct(Client $client, JsonResponse $res)
    {
        $this->client = $client;
        $this->res = $res;
    }

    public function all()
    {
        try {
            $client = $this->client->latest()->get();

            $resource = ClientResource::collection($client);

            return new $this->res($resource, $this->res::HTTP_OK);
        } catch (\Throwable) {
            throw new HttpException($this->res::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan di server internal');
        }
    }

    public function save($request)
    {
        $client = new $this->client;

        $client->identifier = $request['identifier'];
        $client->password = $request['password'];

        try {
            $client->save();

            $resource = new ClientResource($client);

            return new $this->res($resource, $this->res::HTTP_CREATED);
        } catch (\Throwable) {
            throw new HttpException($this->res::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan di server internal');
        }
    }

    public function show($uuid)
    {
        try {
            $client = $this->client->findOrFail($uuid);

            $resource = new ClientResource($client);

            return new $this->res($resource, $this->res::HTTP_OK);
        } catch (ModelNotFoundException) {
            throw new HttpException($this->res::HTTP_NOT_FOUND, 'Client tidak ditemukan');
        } catch (\Throwable) {
            throw new HttpException($this->res::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan di server internal');
        }
    }

    public function update($request, $uuid)
    {

        try {
            $client = $this->client->findOrFail($uuid);

            $client->identifier = $request['identifier'];
            $client->password = $request['password'];

            $client->update();

            $resource = new ClientResource($client);

            return new $this->res($resource, $this->res::HTTP_CREATED);
        } catch (ModelNotFoundException) {
            throw new HttpException($this->res::HTTP_NOT_FOUND, 'Client tidak ditemukan');
        } catch (\Throwable) {
            throw new HttpException($this->res::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan di server internal');
        }
    }

    public function delete($uuid)
    {

        try {
            $client = $this->client->findOrFail($uuid);

            $client->delete();

            return new $this->res(true, $this->res::HTTP_OK);
        } catch (ModelNotFoundException) {
            throw new HttpException($this->res::HTTP_NOT_FOUND, 'Client tidak ditemukan');
        } catch (\Throwable) {
            throw new HttpException($this->res::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan di server internal');
        }
    }
}
