<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'price',
        'cost',
        'department_id',
        'is_commissionable',
        'commission_type',
        'commission_value',
        'commission_tiers',
        'taxable',
        'active',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost' => 'decimal:2',
        'is_commissionable' => 'boolean',
        'commission_value' => 'decimal:2',
        'commission_tiers' => 'array',
        'taxable' => 'boolean',
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
