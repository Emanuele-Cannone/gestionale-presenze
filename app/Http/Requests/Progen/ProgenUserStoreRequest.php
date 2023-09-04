<?php

namespace App\Http\Requests\Progen;

use Illuminate\Foundation\Http\FormRequest;

class ProgenUserStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'users' => ['array'],
            'users_type' => ['string','required']
        ];
    }

    // /**
    //  * Get the error messages for the defined validation rules.
    //  *
    //  * @return array<string, string>
    //  */
    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'A title is required',
    //         'customer_code.required' => 'A message is required',
    //         'upload_method.required' => 'A message is required',
    //     ];
    // }
}
