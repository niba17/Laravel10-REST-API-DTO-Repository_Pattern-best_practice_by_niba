<?php

namespace App\Services;

use App\Models\Client;
use App\Contracts\ClientServiceInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientService
{
    private $client;
    private $clientRepository;

    public function __construct(Client $client, ClientServiceInterface $clientRepository)
    {
        $this->client = $client;
        $this->clientRepository = $clientRepository;
    }

    public function all()
    {
        $client = $this->clientRepository->all();

        return $client;
    }

    public function save($request)
    {
        $client = $this->clientRepository->save($request);

        return $client;
    }

    public function show($uuid)
    {
        $client = $this->clientRepository->show($uuid);

        return $client;
    }

    public function update($request, $uuid)
    {
        $client = $this->clientRepository->show($uuid);

        return $client;
    }

    public function delete($uuid)
    {
        $client = $this->clientRepository->delete($uuid);

        return $client;
    }
}
