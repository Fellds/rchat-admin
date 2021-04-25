<?php

namespace App\Http\Controllers;

use App\Http\Requests\RadioCreateRequest;
use App\Http\Requests\RadioUpdateRequest;

use App\Http\Repositories\Contracts\RadioRepositoryInterface;
use App\Models\Radio;

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
        return parent::renderCreate();
    }

    public function store(RadioCreateRequest $request)
    {
        $radio = $this->radioRepository->create([
            'name' => $request->radio_name,
            'frequency' => $request->frequency,
            'logo' => $request->logo, 
        ]);

        return [
            'id' => $radio->id,
            'name' => $radio->name,
            'frequency' => $radio->frequency
        ];
    }

    public function show(Radio $radio)
    {
        return $radio;
    }

    public function update(RadioUpdateRequest $request, Radio $radio)
    {
        $updated = $this->radioRepository->update(
            $radio,
            [
                'name' => $request->radio_name,
                'frequency' => $request->frequency,
                'logo' => $request->logo, 
            ]
        );

        return $updated;
    }
}
