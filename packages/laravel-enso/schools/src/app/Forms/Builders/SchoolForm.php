<?php

namespace LaravelEnso\Schools\app\Forms\Builders;

use LaravelEnso\Schools\app\Models\School;
use LaravelEnso\FormBuilder\app\Classes\Form;

class SchoolForm
{
    private const TemplatePath = __DIR__.'/../Templates/school.json';

    private $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(School $school)
    {
        return $this->form->edit($school);
    }

    private function templatePath()
    {
        $file = config('enso.schools.formTemplate');
        $templatePath = base_path($file);

        return $file && \File::exists($templatePath)
            ? $templatePath
            : self::TemplatePath;
    }
}
