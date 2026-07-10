<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Customer;
use App\Models\ItemTransaksi;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerIds = Customer::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            // Buat transaksi baru
            $transaksi = Transaksi::create([
                'customer_id' => fake()->randomElement($customerIds),
                'cost' => rand(50000, 100000),
                'total' => rand(100000, 200000),
                'transaction_code' => strtoupper(Str::random(10)),
                'created_at' => Carbon::now()->subDays(rand(0, 60)),
                'updated_at' => now(),
            ]);

            // Tambahkan 1–5 item untuk transaksi ini
            for ($j = 0; $j < rand(1, 5); $j++) {
                ItemTransaksi::create([
                    'order_id' => $transaksi->id,
                    'product_id' => fake()->randomElement($productIds),
                    'cost' => rand(50000, 100000),
                    'price' => rand(100000, 200000),
                    'quantity' => rand(1, 10),
                    'created_at' => Carbon::now()->subDays(rand(0, 60)),
                    'updated_at' => now(),
                ]);
            }
        }
    }

}
