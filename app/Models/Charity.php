<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Charity extends Model
{
    /** @use HasFactory<\Database\Factories\CharityFactory> */
    use HasFactory;
    // match migration
    protected $table = 'charities';
    protected $primaryKey = 'charity_id';
    public $timestamps = false;

    // safe attributes for mass assignment
    protected $fillable = [
        'request_id',
        'raised',
        'charity_status',
    ];

    // hide internal fields from JSON if desired
    protected $hidden = [
        // 'request_id',
    ];

    // type casts
    protected $casts = [
        'raised' => 'integer',
    ];

    // status constants for convenience
    public const STATUS_ONGOING = 'Ongoing';
    public const STATUS_FINISHED = 'Finished';
    public const STATUS_CANCELLED = 'Cancelled';

    // // relations
    public function charity_request()
    {
        return $this->belongsTo(Charity_Request::class, 'request_id', 'request_id');
    }

    public function donators()
    {
        return $this->hasMany(Donator::class, 'charity_id', 'charity_id');
    }
}
