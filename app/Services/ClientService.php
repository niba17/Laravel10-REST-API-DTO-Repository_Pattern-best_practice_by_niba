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
        try {
            $client = $this->clientRepository->all();

            return $client;
        } catch (HttpException $exception) {
            return $exception;
        }
    }

    public function save($request)
    {
        try {
            $client = $this->clientRepository->save($request);

            return $client;
        } catch (HttpException $exception) {
            return $exception;
        }
    }

    public function show($uuid)
    {
        try {
            $client = $this->clientRepository->show($uuid);

            return $client;
        } catch (HttpException $exception) {
            return $exception;
        }
    }

    public function update($request, $uuid)
    {

        try {
            $client = $this->clientRepository->show($uuid);

            return $client;
        } catch (HttpException $exception) {
            return $exception;
        }
    }

    public function delete($uuid)
    {

        try {
            $client = $this->clientRepository->delete($uuid);

            return $client;
        } catch (HttpException $exception) {
            return $exception;
        }
    }
}
