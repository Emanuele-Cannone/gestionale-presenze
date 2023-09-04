<?php

namespace App\Http\Requests\Progen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Rule;

class ProgenCustomerStoreRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['unique:progen_customers,name','string','required'],
            'customer_code' => ['numeric','unique:progen_customers,customer_code','required'],
            'upload_type' => ['numeric','required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A title is required',
            'customer_code.required' => 'A message is required',
            'upload_type.required' => 'A message is required',
        ];
    }
}
