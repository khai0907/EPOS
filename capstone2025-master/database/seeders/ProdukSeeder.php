<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category; // pastikan model category sudah ada
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $categories = Category::pluck('id')->all(); // ambil semua id kategori

        if (empty($categories)) {
            $this->command->info('Kategori belum ada, buat dulu data kategori');
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name_product' => $faker->words(2, true),
                'category_id' => $faker->randomElement($categories),
                'sell_price' => $faker->numberBetween(50000, 500000),
                'buy_price' => $faker->numberBetween(20000, 400000),
                'stock' => $faker->numberBetween(1, 100),
            ]);
        }
    }

}
