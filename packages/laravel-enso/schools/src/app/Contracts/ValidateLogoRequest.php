<?php

namespace LaravelEnso\Schools\app\Contracts;

use Illuminate\Foundation\Http\FormRequest;

class ValidateLogoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['logo' => 'required|image'];
    }
}
