<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Printer;

class DepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Kitchen', 'code' => 'KITCHEN'],
            ['name' => 'Bar', 'code' => 'BAR'],
            ['name' => 'Ladies Drinks', 'code' => 'LD'],
            ['name' => 'None', 'code' => 'NONE'],
        ];

        foreach ($departments as $dept) {
            $department = Department::create($dept);

            // Create default printer for Kitchen, Bar, and LD
            if (in_array($dept['code'], ['KITCHEN', 'BAR', 'LD'])) {
                Printer::create([
                    'department_id' => $department->id,
                    'name' => $dept['name'] . ' Printer',
                    'printer_path' => null,
                    'template_type' => 'escpos',
                    'template_config' => [
                        'title' => strtoupper($dept['name']) . ' ORDER',
                        'show_fields' => [
                            'order_no',
                            'datetime',
                            'area',
                            'table',
                            'qty',
                            'item_name',
                            'modifiers',
                            'instructions',
                            'encoder',
                        ],
                    ],
                    'active' => true,
                ]);
            }
        }
    }
}
