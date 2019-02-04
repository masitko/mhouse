<?php

namespace LaravelEnso\Schools\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Schools\app\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Schools\app\Forms\Builders\CompanyForm;
use LaravelEnso\Schools\app\Contracts\ValidatesCompanyRequest;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function create(CompanyForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidatesCompanyRequest $request)
    {
        $school = School::create($request->all());

        return [
            'message' => __('The school was successfully created'),
            'redirect' => 'administration.schools.edit',
            'param' => ['school' => $school->id],
        ];
    }

    public function edit(School $school, CompanyForm $form)
    {
        return ['form' => $form->edit($school)];
    }

    public function update(ValidatesCompanyRequest $request, School $school)
    {
        $school->update($request->all());

        return ['message' => __('The school was successfully updated')];
    }

    public function destroy(School $school)
    {
        $school->delete();

        return [
            'message' => __('The school was successfully deleted'),
            'redirect' => 'administration.schools.index',
        ];
    }
}
