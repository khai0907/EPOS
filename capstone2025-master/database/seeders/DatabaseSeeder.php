<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 1 user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Buat 10 customer dummy
        \App\Models\Customer::factory(10)->create();

        // Jalankan seeder transaksi
        $this->call([
            TransaksiSeeder::class,
        ]);
    }
}
