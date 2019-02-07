<?php

namespace App\Http\Controllers\Wheels\Observations;

use App\Observation;
use App\Forms\Builders\Wheels\ObservationForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wheels\ValidateObservationRequest;


class ObservationController extends Controller
{
    public function create(ObservationForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateObservationRequest $request)
    {
        $observation = Observation::create($request->all());

        return [
            'message' => __('The observation was successfully created'),
            'redirect' => 'wheels.observations.edit',
            'param' => ['observation' => $observation->id],
        ];
    }

    public function show(Observation $observation)
    {
        return ['observation' => $observation];
    }

    public function edit(Observation $observation, ObservationForm $form)
    {
        return ['form' => $form->edit($observation)];
    }

    public function update(ValidateObservationRequest $request, Observation $observation)
    {
        $observation->update($request->all());

        return ['message' => __('The observation was successfully updated')];
    }

    public function destroy(Observation $observation)
    {
        $observation->delete();

        return [
            'message' => __('The observation was successfully deleted'),
            'redirect' => 'wheels.observations.index',
        ];
    }
}
