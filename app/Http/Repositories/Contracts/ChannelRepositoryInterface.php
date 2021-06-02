<?php

namespace App\Http\Repositories\Contracts;

use App\Models\Channel;

interface ChannelRepositoryInterface
{
    function findById($id);
    function update(Channel $channel, $data);
}