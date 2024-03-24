<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRequest;
use App\dataTransferObject\ClientDTO;
use App\Contracts\ClientRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientController extends Controller
{
    private $service;
    private $res;

    public function __construct(ClientRepositoryInterface $service, JsonResponse $res)
    {
        $this->service = $service;
        $this->res = $res;
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->service->all();

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }

    }

    public function store(ClientRequest $request): JsonResponse
    {
        try {
            $result = $this->service->save(ClientDTO::apiRequest($request));

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function show($uuid): JsonResponse
    {
        try {
            $result = $this->service->show($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function update(ClientRequest $request, $uuid): JsonResponse
    {
        try {
            $result = $this->service->update(ClientDTO::apiRequest($request), $uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function destroy($uuid): JsonResponse
    {
        try {
            $result = $this->service->delete($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
}
