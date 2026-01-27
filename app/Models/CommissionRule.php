<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule_name',
        'staff_type_applicability',
        'category_id',
        'product_id',
        'commission_model',
        'value',
        'tiers',
        'valid_from',
        'valid_to',
        'active',
    ];

    protected $casts = [
        'staff_type_applicability' => 'array',
        'value' => 'decimal:2',
        'tiers' => 'array',
        'valid_from' => 'date',
        'valid_to' => 'date',
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payoutItems()
    {
        return $this->hasMany(PayoutItem::class);
    }
}
