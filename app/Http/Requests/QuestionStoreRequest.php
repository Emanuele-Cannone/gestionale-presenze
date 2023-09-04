<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        return Auth::id() == $request->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            'user_id' => 'exists:users,id|required',
            'proof_id' => 'exists:proofs,id|required',
            'startDay' => 'string|required',
            'startTime' => 'date_format:H:i|required',
            'endDay' => 'string|required',
            'endTime' => 'date_format:H:i|required',
            'note' => 'string|nullable'
        ];

    }
}
