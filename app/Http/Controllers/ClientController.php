<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Contracts\ClientServiceInterface;

class ClientController extends Controller
{
    private $clientService;
    private $res;

    public function __construct(ClientServiceInterface $clientService, JsonResponse $res)
    {
        $this->clientService = $clientService;
        $this->res = $res;
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->clientService->all();

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }

    }

    public function store(ClientRequest $request): JsonResponse
    {
        try {
            $result = $this->clientService->save($request);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function show($uuid): JsonResponse
    {
        try {
            $result = $this->clientService->show($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function update(ClientRequest $request, $uuid): JsonResponse
    {
        try {
            $result = $this->clientService->update($request, $uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function destroy($uuid): JsonResponse
    {
        try {
            $result = $this->clientService->delete($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
}
