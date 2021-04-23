<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Contracts\RadioRepositoryInterface;

class RadioController extends CrudController
{
    private $radioRepository;

    protected $viewName = "radios";

    function __construct(
        RadioRepositoryInterface $radioRepository
    ) {
        $this->radioRepository = $radioRepository;
    }

    public function index()
    {
        $radios = $this->radioRepository->all();

        return parent::renderIndex([
            "radios" => $radios,
        ]);
    }

    public function create()
    {
        // $channels = $this->channelRepository->all();

        // return parent::renderCreate([
        //     "channels" => $channels,
        // ]);
    }
}
