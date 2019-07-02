<?php

namespace LaravelEnso\Schools\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Schools\app\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Schools\app\Forms\Builders\SchoolForm;
use LaravelEnso\Schools\app\Contracts\ValidatesSchoolRequest;
use LaravelEnso\Schools\app\Contracts\ValidateLogoRequest;

class SchoolController extends Controller
{
    use AuthorizesRequests;

    public function create(SchoolForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidatesSchoolRequest $request)
    {
        $school = School::create($request->all());

        return [
            'message' => __('The school was successfully created'),
            'redirect' => 'administration.schools.edit',
            'param' => ['school' => $school->id],
        ];
    }

    public function logoUpload(ValidateLogoRequest $request, School $school) {

      $response = $school->logoUpload($request->file("logo"));
      return [
        "response" => $response,
        "school" => $school,
        "request" => $request->all()
      ];
    }
  
    public function getLogo(School $school) {

      return $school->inline();
    }
  
    public function edit(School $school, SchoolForm $form)
    {
        return ['form' => $form->edit($school)];
    }

    public function update(ValidatesSchoolRequest $request, School $school)
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
