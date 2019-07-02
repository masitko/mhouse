<?php

namespace App\Http\Controllers\Schools\Classes;

use App\SchoolClass;
use App\Forms\Builders\Schools\SchoolClassForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schools\ValidateSchoolClassRequest;

class SchoolClassController extends Controller {
  public function create(SchoolClassForm $form) {
    return ['form' => $form->create()];
  }

  public function store(ValidateSchoolClassRequest $request) {
    $class = SchoolClass::create($request->all());

    return [
      'message' => __('The class was successfully created'),
      'redirect' => 'schools.classes.edit',
      'param' => ['class' => $class->id],
    ];
  }

  public function show(SchoolClass $class) {
    return ['schoolClass' => $class];
  }

  public function edit(SchoolClass $class, SchoolClassForm $form) {
    // dd($class);
    return ['form' => $form->edit($class)];
  }

  public function update(ValidateSchoolClassRequest $request, SchoolClass $class) {
    $class->update($request->all());

    return ['message' => __('The class was successfully updated')];
  }

  public function destroy(SchoolClass $class) {
    $class->delete();

    return [
      'message' => __('The class was successfully deleted'),
      'redirect' => 'schools.classes.index',
    ];
  }
}
