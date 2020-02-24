<?php

namespace App\Http\Requests\Wheels;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateAreaRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    $id = $this->route('area');
    $areaUnique = Rule::unique('areas', 'name');

    $areaUnique = ($this->method() === 'PATCH')
    ? $areaUnique->ignore($id)
    : $areaUnique;

    return [
      'name' => ['required', $areaUnique],
      'description' => 'nullable',
      'observations' => 'array',
    ];
  }
}
