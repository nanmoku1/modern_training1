<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Fake;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = Fake::create('ja_JP');
        for ($i = 0; $i < 13; $i++)
        {
            \DB::table('product_categories')->insert([
                'name' => "カテゴリー".$fake->numberBetween(1, 100),
                'order_no' => $fake->numberBetween(1, 20),
                'created_at' => new \Datetime(),
            ]);
        }
    }
}
