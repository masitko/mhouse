<?php

namespace LaravelEnso\Schools\app\Http\Requests;

use LaravelEnso\People\app\Models\Person;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'school_id' => 'required|exists:schools,id',
            'id' => 'required|exists:people,id',
            'position' => 'string|nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->method() === 'POST' && $this->personExists()) {
                $validator->errors()
                    ->add('id', 'The selected person is already a person of this school');
            }
        });
    }

    private function personExists()
    {
        return Person::whereId($this->get('id'))
            ->whereSchoolId($this->get('school_id'))
            ->first() !== null;
    }
}
