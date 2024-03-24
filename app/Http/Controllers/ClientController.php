<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRequest;
use App\dataTransferObject\ClientDTO;
use App\Contracts\ClientRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientController extends Controller
{
    private $repository;
    private $res;

    public function __construct(ClientRepositoryInterface $repository, JsonResponse $res)
    {
        $this->repository = $repository;
        $this->res = $res;
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->repository->all();

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }

    }

    public function store(ClientRequest $request): JsonResponse
    {
        try {
            $result = $this->repository->save(ClientDTO::apiRequest($request));

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function show($uuid): JsonResponse
    {
        try {
            $result = $this->repository->show($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function update(ClientRequest $request, $uuid): JsonResponse
    {
        try {
            $result = $this->repository->update(ClientDTO::apiRequest($request), $uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function destroy($uuid): JsonResponse
    {
        try {
            $result = $this->repository->delete($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
}
