<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientController extends Controller
{
    private $clientRepInt;
    private $res;

    public function __construct(ClientRepositoryInterface $clientRepInt, JsonResponse $res)
    {
        $this->clientRepInt = $clientRepInt;
        $this->res = $res;
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->clientRepInt->all();

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }

    }

    public function store(ClientRequest $request): JsonResponse
    {
        try {
            $result = $this->clientRepInt->save($request);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function show($uuid): JsonResponse
    {
        try {
            $result = $this->clientRepInt->show($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function update(ClientRequest $request, $uuid): JsonResponse
    {
        try {
            $result = $this->clientRepInt->update($request, $uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }

    public function destroy($uuid): JsonResponse
    {
        try {
            $result = $this->clientRepInt->delete($uuid);

            return new $this->res(['data' => $result->original], $result->getStatusCode());
        } catch (HttpException $exception) {
            return new $this->res(['error' => $exception->getMessage()], $exception->getStatusCode());
        }
    }
}
