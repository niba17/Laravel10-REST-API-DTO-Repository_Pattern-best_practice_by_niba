<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface ClientRepositoryInterface
{
    public function all(): JsonResponse;
    public function show($uuid): JsonResponse;
    public function save($request): JsonResponse;
    public function update($request, $uuid): JsonResponse;
    public function delete($uuid): JsonResponse;
}
