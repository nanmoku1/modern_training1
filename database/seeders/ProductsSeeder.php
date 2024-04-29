<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 2; $i++) {
            \DB::table('products')->insert([
                'product_category_id' => ($i + 1),
                'name' => '商品' . ($i + 1),
                'price' => 100,
                'description' => "説明1\n説明2",
                'created_at' => new \Datetime(),
            ]);
        }
    }
}
