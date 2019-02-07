<?php

namespace App\Forms\Builders\Wheels;

use App\Observation;
use LaravelEnso\FormBuilder\app\Classes\Form;

class ObservationForm
{
    private const TemplatePath = __DIR__.'/../../Templates/Wheels/observation.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Observation $observation)
    {
        return $this->form->edit($observation);
    }
}
