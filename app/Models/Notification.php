<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     protected $fillable = [
        'title',
        'message',
        'type',
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
