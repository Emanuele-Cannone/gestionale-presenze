<?php

namespace App\Models\Progen;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgenCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customer_code',
        'upload_type'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)
                ->withPivot(['leader', 'user_type']);
    }

}
