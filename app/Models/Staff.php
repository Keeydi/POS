<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'staff_code',
        'full_name',
        'nickname',
        'staff_type',
        'default_allowance',
        'default_commission_profile_id',
        'active',
    ];

    protected $casts = [
        'default_allowance' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function defaultCommissionProfile()
    {
        return $this->belongsTo(CommissionRule::class, 'default_commission_profile_id');
    }
}
