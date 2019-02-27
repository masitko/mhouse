<?php

namespace App\Http\Controllers\Schools\Outcomes;

use App\Forms\Builders\Schools\OutcomeForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\ValidateOutcomeRequest;
use Illuminate\Http\Request;

use App\Outcome;
use App\Wheel;
use App\Area;
use App\Observation;


class OutcomeController extends Controller
{
    public function create(OutcomeForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateOutcomeRequest $request)
    {
        $outcome = Outcome::create($request->all());

        return [
            'message' => __('The outcome was successfully created'),
            'redirect' => 'schools.outcomes.edit',
            'param' => ['outcome' => $outcome->id],
        ];
    }

    public function show(Outcome $outcome)
    {
        return ['outcome' => $outcome];
    }

    public function edit(Outcome $outcome, OutcomeForm $form)
    {
        return ['form' => $form->edit($outcome)];
    }

    public function update(ValidateOutcomeRequest $request, Outcome $outcome)
    {
        $outcome->update($request->all());

        return ['message' => __('The outcome was successfully updated')];
    }

    public function getWheel(Request $request) {

      $filters = json_decode($request->get('filters'));
      
      $wheel = $filters->wheelId?Wheel::find($filters->wheelId):null;
      if( $wheel ) {
        $definition = json_decode($wheel->definition);
        $wheel->areas = Area::find($definition->areas);
        $wheel->observations = Observation::find($definition->observations);
      }

      return [
        'filters' => $filters,
        'wheel' =>  $wheel,
      ];

    }

    public function destroy(Outcome $outcome)
    {
        $outcome->delete();

        return [
            'message' => __('The outcome was successfully deleted'),
            'redirect' => 'schools.outcomes.index',
        ];
    }
}
