<?php

namespace App\Interfaces;


interface BaseRepositoryInterface
{
    public function getAll(): mixed;

    public function get(int|string $id, string $column = "id"): mixed;
}
