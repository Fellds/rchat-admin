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

    public function update(Channel $channel, $data)
    {
        $channel->name = $data['name'];
        $channel->radio_id = $data['radio_id'];
        $channel->save();

        return $channel;
    }
}
