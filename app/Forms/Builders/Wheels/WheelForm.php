<?php

namespace App\Forms\Builders\Wheels;

use App\Wheel;
use LaravelEnso\FormBuilder\app\Classes\Form;

class WheelForm
{
    private const TemplatePath = __DIR__.'/../../Templates/Wheels/wheel.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Wheel $wheel)
    {
        return $this->form->edit($wheel);
    }
}
