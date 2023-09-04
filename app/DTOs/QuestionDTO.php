<?php

namespace App\DTOs;

use Illuminate\Support\Carbon;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class QuestionDTO extends ValidatedDTO
{

    public string $user_id;
    public string $proof_id;
    public string $from;
    public string $to;
    public string $note;


    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'user_id' => 'exists:users,id|required',
            'proof_id' => 'exists:proofs,id|required',
            'from' => 'date|date_format:Y-m-d H:i:s|required',
            'to' => 'date|date_format:Y-m-d H:i:s|after:from|required',
            'note' => 'string|nullable'
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
        return [];
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
            'from' => $this->from,
            'to' => $this->to,
            'note' => $this->note,
            'accepted' => null
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
