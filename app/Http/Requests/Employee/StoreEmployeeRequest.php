<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Employee::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'passport_number' => 'required|string|max:9|regex:/^[A-Z]{2}[0-9]{7}$/|unique:employees,passport_number',
            'last_name' => 'required|string|max:20',
            'first_name' => 'required|string|max:20',
            'middle_name' => 'required|string|max:20',
            'position' => 'required|string|max:50',
            'phone' => 'required|string|max:15|regex:/^\+998\d{9}$/',
            'address' => 'required|string',
            'enterprise_id' => 'required|integer'
        ];
    }
}
