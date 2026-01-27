<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Table;

class AreasAndTablesSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            ['name' => 'Lounge', 'code' => 'LOUNGE', 'tables' => 10],
            ['name' => 'Club', 'code' => 'CLUB', 'tables' => 15],
            ['name' => 'LD', 'code' => 'LD', 'tables' => 8],
        ];

        foreach ($areas as $areaData) {
            $area = Area::create([
                'name' => $areaData['name'],
                'code' => $areaData['code'],
                'active' => true,
                'sort_order' => 0,
            ]);

            // Create tables for this area
            for ($i = 1; $i <= $areaData['tables']; $i++) {
                Table::create([
                    'area_id' => $area->id,
                    'name' => "Table {$i}",
                    'code' => $areaData['code'] . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'status' => 'available',
                    'capacity' => 4,
                    'active' => true,
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
