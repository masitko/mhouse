<?php

namespace App\Forms\Builders\Schools;

use App\Term;
use LaravelEnso\FormBuilder\app\Classes\Form;

use App\Traits\CurrentUser;

class TermForm {
  use CurrentUser;

  private const TemplatePath = __DIR__ . '/../../Templates/Schools/term.json';

  private $form;

  public function __construct() {
    $this->form = new Form(self::TemplatePath);
    if(!$this->getCurrentUser()->can('access-route','administration.schools.options')) {
      $this->form->hide('school_id');
    }
  }

  public function create() {
    $term = new Term();
    $term->school_id = $this->getCurrentUser()->school_id;
    return $this->form->create($term);
  }

  public function edit(Term $term) {
    return $this->form->edit($term);
  }
}
