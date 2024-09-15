<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function find(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function changeStatus(int $id, string $status);
}