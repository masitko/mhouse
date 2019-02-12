<?php

namespace App\Http\Controllers\Wheels\Areas;

use App\Area;
use App\Forms\Builders\Wheels\AreaForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wheels\ValidateAreaRequest;


class AreaController extends Controller
{
    public function create(AreaForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateAreaRequest $request)
    {
        $area = Area::create($request->all());
        $area->associateObservations($request->input('observations'));

        return [
            'message' => __('The area was successfully created'),
            'redirect' => 'wheels.areas.edit',
            'param' => ['area' => $area->id],
        ];
    }

    public function show(Area $area)
    {
        return ['area' => $area];
    }

    public function edit(Area $area, AreaForm $form)
    {
        return ['form' => $form->edit($area)];
    }

    public function update(ValidateAreaRequest $request, Area $area)
    {
        $area->update($request->all());
        $area->associateObservations($request->input('observations'));

        return ['message' => __('The area was successfully updated')];
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return [
            'message' => __('The area was successfully deleted'),
            'redirect' => 'wheels.areas.index',
        ];
    }
}
