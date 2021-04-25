<?php

namespace App\Http\Repositories\Contracts;

use App\Models\Radio;

interface RadioRepositoryInterface
{
    function findById($id);
    function update(Radio $radio, $data);
}
