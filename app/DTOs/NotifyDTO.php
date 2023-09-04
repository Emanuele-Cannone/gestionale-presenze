<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\Casting\IntegerCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class NotifyDTO extends ValidatedDTO
{

    public int $user_id;
    public int $proof_id;
    public int $question_id;
    public array $notificationSendTo;

    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'user_id' => 'exists:users,id|required',
            'proof_id' => 'exists:proofs,id|required',
            'question_id' => 'exists:questions,id|required',
            'notificationSendTo' => 'array|required'
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * Defines the type casting for the properties of the DTO.
     */
    protected function casts(): array
    {
        return [
            'user_id' => new IntegerCast(),
            'proof_id' => new IntegerCast(),
        ];
    }

    /**
     * Maps the DTO properties before the DTO instantiation.
     */
    protected function mapBeforeValidation(): array
    {
        return [];
    }

    /**
     * Maps the DTO properties before the DTO export.
     */
    protected function mapBeforeExport(): array
    {
        return [
            'user_id' => $this->user_id,
            'proof_id' => $this->proof_id,
            'question_id' => $this->question_id,
            'notificationSendTo' => $this->notificationSendTo
        ];
    }

    /**
     * Defines the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Defines the custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [];
    }
}
