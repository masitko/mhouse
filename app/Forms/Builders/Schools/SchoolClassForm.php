<?php

namespace App\Forms\Builders\Schools;

use App\SchoolClass;
use App\Traits\CurrentUser;
use LaravelEnso\FormBuilder\app\Classes\Form;

class SchoolClassForm {
  use CurrentUser;

  private const TemplatePath = __DIR__ . '/../../Templates/Schools/schoolClass.json';

  private $form;

  public function __construct() {
    $this->form = new Form(self::TemplatePath);
    if (!$this->getCurrentUser()->can('access-route', 'administration.schools.options')) {
      $this->form->hide('school_id');
    }
  }

  public function create() {
    return $this->form
      ->value('school_id', $this->getCurrentUser()->school_id)
      ->create();
  }

  public function edit(SchoolClass $schoolClass) {
    return $this->form->edit($schoolClass);
  }
}
