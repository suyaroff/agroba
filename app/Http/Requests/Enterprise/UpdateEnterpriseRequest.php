<?php

namespace App\Http\Requests\Enterprise;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnterpriseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $enterprise = $this->route('enterprise');
        return $this->user()->can('update', $enterprise);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'director_name' => 'sometimes|string|max:50',
            'address' => 'sometimes|string',
            'email' => 'sometimes|string|max:50|email|unique:enterprises,email',
            'website' => 'sometimes|string|max:50',
            'phone' => 'sometimes|string|max:15|regex:/^\+998\d{9}$/',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->all())) {
                $validator->errors()->add('fields', 'At least one field must be present');
            }
        });
    }

}
