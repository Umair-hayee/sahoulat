<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'start_date',
        'due_date',
        'status',
        'user_gig_id',
        'amount',
        'note',
        'is_completed',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function gig()
    {
        return $this->belongsTo(UserGig::class, 'user_gig_id');
    }
}
