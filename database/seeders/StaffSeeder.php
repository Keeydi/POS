<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            ['staff_code' => 'MODEL-001', 'full_name' => 'Jane Doe', 'nickname' => 'Jane', 'staff_type' => 'Model', 'default_allowance' => 500],
            ['staff_code' => 'MODEL-002', 'full_name' => 'Mary Smith', 'nickname' => 'Mary', 'staff_type' => 'Model', 'default_allowance' => 500],
            ['staff_code' => 'HOST-001', 'full_name' => 'John Host', 'nickname' => 'John', 'staff_type' => 'Host', 'default_allowance' => 400],
            ['staff_code' => 'WAIT-001', 'full_name' => 'Sarah Waitress', 'nickname' => 'Sarah', 'staff_type' => 'Waitress', 'default_allowance' => 300],
            ['staff_code' => 'BART-001', 'full_name' => 'Mike Bartender', 'nickname' => 'Mike', 'staff_type' => 'Bartender', 'default_allowance' => 350],
            ['staff_code' => 'KITCH-001', 'full_name' => 'Chef Cook', 'nickname' => 'Chef', 'staff_type' => 'Kitchen', 'default_allowance' => 400],
        ];

        foreach ($staff as $s) {
            Staff::create($s);
        }
    }
}
