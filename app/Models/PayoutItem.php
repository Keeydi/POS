<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'payout_id',
        'order_item_id',
        'commission_rule_id',
        'quantity',
        'unit_commission',
        'total_commission',
        'description',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_commission' => 'decimal:2',
        'total_commission' => 'decimal:2',
    ];

    public function payout()
    {
        return $this->belongsTo(Payout::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function commissionRule()
    {
        return $this->belongsTo(CommissionRule::class);
    }
}
