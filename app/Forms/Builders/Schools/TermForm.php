<?php

namespace App\Forms\Builders\Schools;

use App\Term;
use LaravelEnso\FormBuilder\app\Classes\Form;

class TermForm
{
    private const TemplatePath = __DIR__.'/../../Templates/Schools/term.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Term $term)
    {
        return $this->form->edit($term);
    }
}
