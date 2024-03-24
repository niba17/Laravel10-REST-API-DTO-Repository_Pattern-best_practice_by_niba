<?php

namespace App\Services;

use App\dataTransferObject\ClientDTO;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Contracts\ClientRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ClientService
{
    private $client;
    private $repository;

    public function __construct(Client $client, ClientRepositoryInterface $repository)
    {
        $this->client = $client;
        $this->repository = $repository;
    }

    public function all(): JsonResponse
    {
        $client = $this->repository->all();

        return $client;
    }

    public function save(ClientRequest $request): JsonResponse
    {
        $client = $this->repository->save($request);

        return $client;
    }

    public function show($uuid): JsonResponse
    {
        $client = $this->repository->show($uuid);

        return $client;
    }

    public function update($request, $uuid): JsonResponse
    {
        $client = $this->repository->update($uuid);

        return $client;
    }

    public function delete($uuid): JsonResponse
    {
        $client = $this->repository->delete($uuid);

        return $client;
    }
}
