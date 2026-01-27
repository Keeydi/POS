<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessSetting;

class BusinessSettingsSeeder extends Seeder
{
    public function run(): void
    {
        BusinessSetting::create([
            'business_name' => 'Rabbit Alley',
            'address' => '123 Club Street, City',
            'contact' => '+63 123 456 7890',
            'receipt_footer_note' => 'Thank you for visiting!',
            'tax_rate' => 0,
            'service_charge_rate' => 0,
            'service_charge_mode' => 'percent',
            'service_charge_fixed' => 0,
        ]);
    }
}
