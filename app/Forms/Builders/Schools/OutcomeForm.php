<?php

namespace App\Forms\Builders\Schools;

use App\Outcome;
use LaravelEnso\FormBuilder\app\Classes\Form;

class OutcomeForm
{
    private const TemplatePath = __DIR__.'/../../Templates/Schools/outcome.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Outcome $outcome)
    {
        return $this->form->edit($outcome);
    }
}
