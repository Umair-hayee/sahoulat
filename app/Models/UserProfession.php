<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfession extends Model
{
    use HasFactory;

    protected $fillable  = [
        'user_id',
        'profession'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
