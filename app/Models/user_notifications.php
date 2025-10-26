<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_notifications extends Model
{
    protected $table = 'user_notifications';
    protected $primaryKey = 'notif_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
