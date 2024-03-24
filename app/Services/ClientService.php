<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use App\dataTransferObject\ClientDTO;
use App\Contracts\ClientRepositoryInterface;

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

    public function save(ClientDTO $request): JsonResponse
    {
        $client = $this->repository->save($request);

        return $client;
    }

    public function show($uuid): JsonResponse
    {
        $client = $this->repository->show($uuid);

        return $client;
    }

    public function update(ClientDTO $request, $uuid): JsonResponse
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
