<?php

namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface
{
    public function all();
    public function show($uuid);
    public function save($request);
    public function update($request, $uuid);
    public function delete($uuid);
}
