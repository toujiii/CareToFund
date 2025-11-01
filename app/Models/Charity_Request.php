<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity_Request extends Model
{
    /** @use HasFactory<\Database\Factories\CharityRequestFactory> */
    use HasFactory;
    protected $table = 'charity_requests';
    protected $primaryKey = 'request_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'datetime',
        'approved_datetime',
        'fund_limit',
        'duration',
        'id_type_used',
        'id_number',
        'id_att_link',
        'front_face_link',
        'side_face_link',
        'request_status',
        'user_id',
    ];

    // hide internal file links if you expose files via routes/resources instead
    protected $hidden = [
        'id_att_link',
        'front_face_link',
        'side_face_link',
    ];

    protected $casts = [
        'request_id' => 'integer',
        'datetime' => 'datetime',
        'approved_datetime' => 'datetime',
        'fund_limit' => 'integer',
        'duration' => 'integer',
        'user_id' => 'integer',
    ];

    // convenience constants
    public const ID_PASSPORT = 'Passport';
    public const ID_DRIVERS_LICENSE = "Driver's License";
    public const ID_NATIONAL = 'National ID';

    public const STATUS_PENDING = 'Pending';
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_REJECTED = 'Rejected';
    public const STATUS_CANCELLED = 'Cancelled';

    // relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function charity()
    {
        return $this->hasOne(Charity::class, 'request_id', 'request_id');
    }
}
