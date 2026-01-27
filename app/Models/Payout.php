<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'payout_date',
        'shift_id',
        'allowance',
        'commission',
        'adjustments',
        'deductions',
        'net_payout',
        'adjustment_reason',
        'approved_by',
        'status',
        'finalized_at',
        'printed_at',
    ];

    protected $casts = [
        'payout_date' => 'date',
        'allowance' => 'decimal:2',
        'commission' => 'decimal:2',
        'adjustments' => 'decimal:2',
        'deductions' => 'decimal:2',
        'net_payout' => 'decimal:2',
        'finalized_at' => 'datetime',
        'printed_at' => 'datetime',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(PayoutItem::class);
    }
}
