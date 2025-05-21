<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('employee'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'passport_number' => 'sometimes|string|max:9|regex:/^[A-Z]{2}[0-9]{7}$/|unique:employees,passport_number',
            'last_name' => 'sometimes|string|max:20',
            'first_name' => 'sometimes|string|max:20',
            'middle_name' => 'sometimes|string|max:20',
            'position' => 'sometimes|string|max:50',
            'phone' => 'sometimes|string|max:15|regex:/^\+998\d{9}$/',
            'address' => 'sometimes|string',
            'enterprise_id' => 'sometimes|integer'
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
