<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'address',
        'contact',
        'receipt_footer_note',
        'tax_rate',
        'service_charge_rate',
        'service_charge_mode',
        'service_charge_fixed',
    ];

    protected $casts = [
        'tax_rate' => 'decimal:2',
        'service_charge_rate' => 'decimal:2',
        'service_charge_fixed' => 'decimal:2',
    ];

    public static function getSettings()
    {
        return static::first() ?? static::create([
            'business_name' => 'Rabbit Alley',
            'tax_rate' => 0,
            'service_charge_rate' => 0,
            'service_charge_mode' => 'percent',
            'service_charge_fixed' => 0,
        ]);
    }
}
