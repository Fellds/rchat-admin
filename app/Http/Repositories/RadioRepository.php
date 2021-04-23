<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\RadioRepositoryInterface;
use App\Http\Repositories\BaseRepository;
use App\Models\Radio;

class RadioRepository extends BaseRepository implements RadioRepositoryInterface
{
    protected $model;

    public function __construct(Radio $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }
}
