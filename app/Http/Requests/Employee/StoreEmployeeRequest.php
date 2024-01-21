<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->where(function ($query) {
                    $query->where('company_id', $this->company_id)
                        ->whereNull('deleted_at');
                }),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('employees', 'phone')->where(function ($query) {
                    $query->where('company_id', $this->company_id)
                        ->whereNull('deleted_at');
                }),
            ],
        ];

    }
}
