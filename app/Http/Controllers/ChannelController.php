<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChannelCreateRequest;
use App\Http\Requests\ChannelUpdateRequest;

use App\Http\Repositories\Contracts\ChannelRepositoryInterface;
use App\Models\Channel;

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

    public function store(ChannelCreateRequest $request)
    {
        $channel = $this->channelRepository->create([
            'name' => $request->name, 
            'radio_id' => $request->radio_id, 
        ]);

        return [
            'id' => $channel->id,
            'name' => $channel->name,
            'radio_id' => $channel->radio_id
        ];
    }

    public function show(Channel $channel)
    {
        return $channel;
    }

    public function update(ChannelUpdateRequest $request, Channel $channel)
    {
        $updated = $this->channelRepository->update(
            $channel,
            [
                'name' => $request->name,
                'radio_id' => $request->radio_id, 
            ]
        );

        return $updated;
    } 

    public function destroy(Channel $channel)
    {
        $this->channelRepository->destroy($channel->id);
        
        return [
            'id' => $channel->id,
        ];
    }
}
