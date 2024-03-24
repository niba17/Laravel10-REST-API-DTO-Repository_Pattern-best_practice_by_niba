<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use App\dataTransferObject\ClientDTO;

interface ClientRepositoryInterface
{
    public function all(): JsonResponse;
    public function show($uuid): JsonResponse;
    public function save(ClientDTO $request): JsonResponse;
    public function update(ClientDTO $request, $uuid): JsonResponse;
    public function delete($uuid): JsonResponse;
}
