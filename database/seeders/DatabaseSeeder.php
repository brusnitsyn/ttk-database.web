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
        ]); //1
        DB::table('machine_types')->insert([
            'name' => "Плуги чизельные",
            'brand_id' => 1,
        ]); //2
        DB::table('machine_types')->insert([
            'name' => "Плуги оборотные",
            'brand_id' => 1,
        ]); //3
        DB::table('machine_types')->insert([
            'name' => "Бороны и лущильники",
            'brand_id' => 1,
        ]); //4
        DB::table('machine_types')->insert([
            'name' => "Комбайны",
            'brand_id' => 2,
        ]); //5
        DB::table('machine_types')->insert([
            'name' => "Трактора",
            'brand_id' => 2,
        ]); //6

        DB::table('machines')->insert([
            'name' => "ПЛН 3-35",
            'machine_type_id' => 4,
        ]); //1
        DB::table('machines')->insert([
            'name' => "ПЛН 4-35",
            'machine_type_id' => 4,
        ]); //2

        DB::table('machines')->insert([
            'name' => "Бюлер",
            'machine_type_id' => 6,
        ]); //3

        // DB::table('products')->insert([
        //     'name' => "Форсунки",
        //     'article' => "231686",
        //     'brand_id' => 2,
        //     'actual_price' => 4300,
        //     'weight' => 3.20,
        //     'width' => 340,
        //     'height' => 54,
        //     'length' => 132,
        //     'preview_image' => "/img/product-test-img.png",
        // ]);
        // DB::table('products')->insert([
        //     'name' => "Башмак",
        //     'article' => "РЗЗ ПЛН.02.33",
        //     'actual_price' => 2300,
        //     'brand_id' => 1,
        //     'weight' => 5.20,
        //     'width' => 234,
        //     'height' => 65,
        //     'length' => 124,
        //     'hole' => "1 отверстие - 32 мм",
        //     'preview_image' => "/img/product-test-img.png",
        // ]);
        // DB::table('machine_for_products')->insert([
        //     'product_id' => 1,
        //     'machine_id' => 3
        // ]);
        // DB::table('machine_for_products')->insert([
        //     'product_id' => 2,
        //     'machine_id' => 1
        // ]);
        // DB::table('machine_for_products')->insert([
        //     'product_id' => 2,
        //     'machine_id' => 2
        // ]);
    }
}
