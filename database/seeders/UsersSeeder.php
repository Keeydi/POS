<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::all()->keyBy('name');

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@pos.local',
                'employee_id' => 'EMP001',
                'password' => bcrypt('password'),
                'role' => 'SuperAdmin',
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@pos.local',
                'employee_id' => 'EMP002',
                'password' => bcrypt('password'),
                'role' => 'Manager',
            ],
            [
                'name' => 'Cashier',
                'email' => 'cashier@pos.local',
                'employee_id' => 'EMP003',
                'password' => bcrypt('password'),
                'role' => 'Cashier',
            ],
            [
                'name' => 'Waitress',
                'email' => 'waitress@pos.local',
                'employee_id' => 'EMP004',
                'password' => bcrypt('password'),
                'role' => 'Waitress',
            ],
            [
                'name' => 'Bartender',
                'email' => 'bartender@pos.local',
                'employee_id' => 'EMP005',
                'password' => bcrypt('password'),
                'role' => 'Bartender',
            ],
            [
                'name' => 'Kitchen Staff',
                'email' => 'kitchen@pos.local',
                'employee_id' => 'EMP006',
                'password' => bcrypt('password'),
                'role' => 'Kitchen',
            ],
            [
                'name' => 'LD Manager',
                'email' => 'ldmanager@pos.local',
                'employee_id' => 'EMP007',
                'password' => bcrypt('password'),
                'role' => 'LD_Manager',
            ],
            [
                'name' => 'Auditor',
                'email' => 'auditor@pos.local',
                'employee_id' => 'EMP008',
                'password' => bcrypt('password'),
                'role' => 'Auditor',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'employee_id' => $userData['employee_id'],
                    'password' => $userData['password'],
                    'email_verified_at' => now(),
                ]
            );

            if (isset($roles[$userData['role']])) {
                // Remove all existing roles and assign the correct one
                $user->syncRoles([$userData['role']]);
            }
        }
    }
}
