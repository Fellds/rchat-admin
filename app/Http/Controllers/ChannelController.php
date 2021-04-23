<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Contracts\ChannelRepositoryInterface;

class ChannelController extends CrudController
{
    private $channelRepository;

    protected $viewName = "channels";

    function __construct(
        ChannelRepositoryInterface $channelRepository
    ) {
        $this->channelRepository = $channelRepository;
    }

    public function index()
    {
        $channels = $this->channelRepository->all();

        return parent::renderIndex([
            "channels" => $channels,
        ]);
    }

    public function create()
    {
        $channels = $this->channelRepository->all();

        return parent::renderCreate([
            "channels" => $channels,
        ]);
    }
}
