<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ChannelRepositoryInterface;
use App\Http\Repositories\BaseRepository;
use App\Models\Channel;

class ChannelRepository extends BaseRepository implements ChannelRepositoryInterface
{
    protected $model;

    public function __construct(Channel $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }
}
