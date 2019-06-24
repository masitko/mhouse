<?php

namespace LaravelEnso\Schools\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Schools\app\Contracts\ValidatesSchoolRequest;

class ValidateSchoolRequest extends FormRequest implements ValidatesSchoolRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $nameUnique = Rule::unique('schools', 'name');

        if ($this->method() === 'PATCH') {
            $nameUnique = $nameUnique->ignore($this->route('school')->id);
        }

        return [
            'name' => ['required', 'string', $nameUnique],
            'dfe' => ['required', 'string'],
            'email' => 'email|nullable',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'notes' => 'string|nullable',
        ];
    }

    public function withValidator($validator)
    {
        if (! $this->filled('mandatary_id')) {
            return;
        }

        $validator->after(function ($validator) {
            if (! $this->mandataryIsAssociated()) {
                $validator->errors()->add('mandatary_id', 'This person is not associated with the current school');
            }
        });
    }

    private function mandataryIsAssociated()
    {
        return $this->route('school')->people()
            ->pluck('id')
            ->contains($this->get('mandatary_id'));
    }
}
