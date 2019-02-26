<?php

namespace App\Forms\Builders\Schools;

use App\Term;
use App\Traits\CurrentUser;
use LaravelEnso\FormBuilder\app\Classes\Form;

class TermForm {
  use CurrentUser;

  private const TemplatePath = __DIR__ . '/../../Templates/Schools/term.json';

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

  public function edit(Term $term) {
    return $this->form->edit($term);
  }
}
