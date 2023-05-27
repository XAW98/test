<?php

namespace App\Repository;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\BaseModel;

class BaseRepository implements BaseRepositoryInterface
{

    protected static BaseModel $module;

    public function __construct(BaseModel $module)
    {
        $this->module = $module;
    }

    protected function query(): mixed
    {
        return $this->module->query();
    }

    public function getAll(): mixed
    {
        return $this->module->all();
    }

    public function get(int|string $id, string $column = "id"): mixed
    {
        return $this->query()->where($column, $id)->get();
    }
}
