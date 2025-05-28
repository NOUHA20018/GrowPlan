<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     protected $fillable = [
        'message',
        'user_id',
        'type',
        'actor_id',
        'is_read',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function markAsRead()
    {
        $this->is_read = true;
        $this->save();
    }
}
