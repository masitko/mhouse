<?php

namespace App\Http\Controllers\Wheels\Wheels;

use App\Wheel;
use App\Forms\Builders\Wheels\WheelForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wheels\ValidateWheelRequest;


class WheelController extends Controller
{
    public function create(WheelForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateWheelRequest $request)
    {
        $wheel = Wheel::create($request->all());

        return [
            'message' => __('The wheel was successfully created'),
            'redirect' => 'wheels.wheels.edit',
            'param' => ['wheel' => $wheel->id],
        ];
    }

    public function show(Wheel $wheel)
    {
        return ['wheel' => $wheel];
    }

    public function edit(Wheel $wheel, WheelForm $form)
    {
        return ['form' => $form->edit($wheel)];
    }

    public function update(ValidateWheelRequest $request, Wheel $wheel)
    {
        $wheel->update($request->all());

        return ['message' => __('The wheel was successfully updated')];
    }

    public function destroy(Wheel $wheel)
    {
        $wheel->delete();

        return [
            'message' => __('The wheel was successfully deleted'),
            'redirect' => 'wheels.wheels.index',
        ];
    }
}
