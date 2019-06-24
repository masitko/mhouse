<?php

namespace LaravelEnso\Core\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateUserRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $id = $this->route('user') ? $this->route('user') : $this->route('student');
    $emailUnique = Rule::unique('users', 'email');

    $emailUnique = ($this->method() === 'PATCH')
      ? $emailUnique->ignore($id)
      : $emailUnique;

    return [
      // 'person_id' => 'exists:people,id',
      'first_name' => 'required',
      'last_name' => 'required',
      // 'group_id' => 'required|exists:user_groups,id',
      'role_id' => 'required|exists:roles,id',
      'school_id' => '',
      'email' => ['email', 'required', $emailUnique],
      'password' => 'nullable|confirmed|min:' . config('enso.auth.password.minLength'),
      'is_active' => 'boolean',
      'birthday' => 'date|nullable',
      'admission_date' => 'date|nullable',
      'ethnicity' => 'integer|nullable',
      'gender' => 'integer|nullable',
      'idaci' => 'string|nullable',
      'upn' => 'string|nullable',
      'flag_fsm' => 'boolean',
      'post_cla' => 'boolean',
      'flag_cla' => 'boolean',
      'flag_sen' => 'boolean',

    ];
  }

  public function withValidator($validator)
  {
    if ($this->filled('password')) {
      $validator->after(function ($validator) {
        (new PasswordValidator($this, $validator))
          ->handle();
      });
    }
  }
}
