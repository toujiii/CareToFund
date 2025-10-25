<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donator extends Model
{
    use HasFactory;

    protected $table = 'donators';
    protected $primaryKey = 'donator_id';
    public $timestamps = true;

    protected $fillable = [
        'amount',
        'payment_method',
    ];

    protected $hidden = [
        'user_id',
        'charity_id',
    ];

    protected $casts = [
        'donator_id' => 'integer',
        'amount' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function charity()
    {
        return $this->belongsTo(Charity::class, 'charity_id', 'charity_id');
    }
}
