<?php

namespace App\Http\Controllers\Schools\Outcomes;

use App\Outcome;
use App\Forms\Builders\Schools\OutcomeForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\ValidateOutcomeRequest;


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

    public function destroy(Outcome $outcome)
    {
        $outcome->delete();

        return [
            'message' => __('The outcome was successfully deleted'),
            'redirect' => 'schools.outcomes.index',
        ];
    }
}
