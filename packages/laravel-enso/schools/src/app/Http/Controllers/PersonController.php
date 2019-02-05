<?php

namespace LaravelEnso\Schools\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Schools\app\Models\School;
use LaravelEnso\Schools\app\Forms\Builders\PersonForm;
use LaravelEnso\Schools\app\Http\Resources\Person as Resource;
use LaravelEnso\Schools\app\Http\Requests\ValidatePersonRequest;

class PersonController extends Controller
{
    public function index(School $school)
    {
        return Resource::collection(
            $school->people()->get()
        );
    }

    public function create(School $school, PersonForm $form)
    {
        return ['form' => $form->create($school)];
    }

    public function store(ValidatePersonRequest $request)
    {
        Person::find($request->get('id'))
            ->update($request->validated());

        return [
            'message' => __('The Person was successfully created'),
        ];
    }

    public function edit(Person $person, PersonForm $form)
    {
        return ['form' => $form->edit($person)];
    }

    public function update(ValidatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        return [
            'message' => __('The Person have been successfully updated'),
        ];
    }

    public function destroy(Person $person)
    {
        $person->dissociateSchool();
    }
}
