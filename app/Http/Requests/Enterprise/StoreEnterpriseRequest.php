<?php

namespace App\Http\Requests\Enterprise;

use App\Models\Enterprise;
use Illuminate\Foundation\Http\FormRequest;

class StoreEnterpriseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Enterprise::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'director_name' => 'required|string|max:50',
            'address' => 'required|string',
            'email' => 'required|string|max:50|email|unique:enterprises,email',
            'website' => 'string|max:50',
            'phone' => 'required|string|max:15|regex:/^\+998\d{9}$/',
            'owner_id' => 'required|integer'
        ];
    }
}
