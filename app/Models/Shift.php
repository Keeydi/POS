<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'shift_date',
        'shift_open',
        'shift_close',
        'status',
        'attendance_met',
    ];

    protected $casts = [
        'shift_date' => 'date',
        'shift_open' => 'datetime',
        'shift_close' => 'datetime',
        'attendance_met' => 'boolean',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }
}
