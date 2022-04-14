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
        DB::table('brands')->insert([
            'name' => "Алмаз",
        ]);
        DB::table('brands')->insert([
            'name' => "Ростсельмаш",
        ]);

        DB::table('machine_types')->insert([
            'name' => "Плуги общего назначения",
            'brand_id' => 1,
        ]);
        DB::table('machine_types')->insert([
            'name' => "Плуги чизельные",
            'brand_id' => 1,
        ]);
        DB::table('machine_types')->insert([
            'name' => "Плуги оборотные",
            'brand_id' => 1,
        ]);
        DB::table('machine_types')->insert([
            'name' => "Бороны и лущильники",
            'brand_id' => 1,
        ]);
        DB::table('machine_types')->insert([
            'name' => "Комбайны",
            'brand_id' => 2,
        ]);
        DB::table('machine_types')->insert([
            'name' => "Трактора",
            'brand_id' => 2,
        ]);

        DB::table('machines')->insert([
            'name' => "ПЛН 3-35",
            'brand_id' => 1,
            'machine_type_id' => 6,
        ]);
        DB::table('machines')->insert([
            'name' => "ПЛН 4-35",
            'brand_id' => 1,
            'machine_type_id' => 6,
        ]);

        DB::table('machines')->insert([
            'name' => "Бюлер",
            'brand_id' => 2,
            'machine_type_id' => 6,
        ]);
    }
}
