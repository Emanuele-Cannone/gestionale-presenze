<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proof extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    /**
     * @return BelongsTo<Roster>
     */
    public function roster(): BelongsTo
    {
        return $this->BelongsTo(Roster::class);
    }

    
}
