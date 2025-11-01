<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_Notifications extends Model
{

    use HasFactory;
    
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
