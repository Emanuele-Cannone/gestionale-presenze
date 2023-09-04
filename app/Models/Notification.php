<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'proof_id',
        'users_to'
    ];


    /**
     * @return BelongsTo<User>
     */
    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * @return BelongsTo<Proof>
     */
    public function proof():BelongsTo
    {
        return $this->BelongsTo(Proof::class);
    }
}
