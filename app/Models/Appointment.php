<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'reason',
        'begin',
        'start',
        'end',
        'session',
        'booked_by',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
