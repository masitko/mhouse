<?php

namespace App\Forms\Builders\Schools;

use App\SchoolClass;
use LaravelEnso\FormBuilder\app\Classes\Form;

class SchoolClassForm
{
    private const TemplatePath = __DIR__.'/../../Templates/Schools/schoolClass.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form(self::TemplatePath);
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(SchoolClass $schoolClass)
    {
        return $this->form->edit($schoolClass);
    }
}
