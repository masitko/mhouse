<?php

namespace App\Forms\Builders\Wheels;

use App\Area;
use LaravelEnso\FormBuilder\app\Classes\Form;

class AreaForm
{
    private const TemplatePath = __DIR__.'/../../Templates/Wheels/area.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Area $area)
    {
        return $this->form->edit($area);
    }
}
