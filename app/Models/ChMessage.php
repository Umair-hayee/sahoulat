<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
