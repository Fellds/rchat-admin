<?php

namespace App\Http\Repositories\Contracts;

interface ChannelRepositoryInterface
{
    function findById($id);
    function all();
}
