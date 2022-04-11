<?php

namespace Database\Seeders;

use App\Models\EquipmentManufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('equipment_manufacturers')->insert([
            'name' => "Алмаз",
        ]);

        DB::table('techniques')->insert([
            'name' => "БДТ-6",
            'equipment_manufacturer_id' => 1,
        ]);
    }
}
