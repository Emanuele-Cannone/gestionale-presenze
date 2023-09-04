<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'proof_id',
        'from',
        'to',
        'accepted',
        'note'
    ];


    /**
     * @return belongsTo<User>
     */
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return belongsTo<Proof>
     */
    public function proof():belongsTo
    {
        return $this->belongsTo(Proof::class);
    }
}
