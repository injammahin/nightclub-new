<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationSubmission extends Model
{
    protected $fillable = [
        'selected_package',
        'name',
        'email',
        'phone',
        'event_date',
        'request_type',
        'guests',
        'message',
        'status',
        'read_at',
    ];

    protected $casts = [
        'event_date' => 'date',
        'read_at' => 'datetime',
    ];
}