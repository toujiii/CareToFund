<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */

    use SoftDeletes;

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gcash_number',
        'status',
        'role',
        'provider',
        'provider_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'user_front_link',
        'user_side_link',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public const STATUS_PENDING = 'Pending';
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_OFFLINE = 'Offline';
    public const STATUS_NOTIFIED = 'Notified';

    public function donators()
    {
        return $this->hasMany(Donator::class, 'user_id', 'id');
    }

    public function charity_request()
    {
        return $this->hasMany(Charity_Request::class, 'user_id', 'id');
    }

    public function user_notifications()
    {
        return $this->hasMany(User_Notifications::class, 'user_id', 'id');
    }
}
