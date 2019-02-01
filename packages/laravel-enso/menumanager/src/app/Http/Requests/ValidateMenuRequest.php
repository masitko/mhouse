<?php

namespace LaravelEnso\MenuManager\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateMenuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $nameUnique = Rule::unique('menus', 'name')
            ->where(function ($query) {
                return $query->whereParentId($this->parent_id);
            });

        $nameUnique = ($this->method() === 'PATCH')
            ? $nameUnique->ignore($this->route('menu')->id)
            : $nameUnique;

        return [
            'parent_id' => 'nullable',
            'permission_id' => 'nullable|exists:permissions,id',
            'name' => [$nameUnique, 'required'],
            'icon' => 'required',
            'has_children' => 'boolean',
            'order_index' => 'numeric|required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->get('has_children') && $this->filled('permission_id')) {
                $validator->errors()->add('has_children', 'The menu must not to be a parent if the route is not null');
                $validator->errors()->add('permission_id', 'The route has to be null if the menu is a parent');
            }

            if (! $this->get('has_children') && ! $this->filled('permission_id')) {
                $validator->errors()->add('has_children', 'The menu must be a parent if the route is null');
                $validator->errors()->add('permission_id', 'The route cannot be null if the menu is not a parent');
            }
        });
    }
}
