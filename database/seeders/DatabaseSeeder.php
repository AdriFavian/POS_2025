<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            KategoriSeeder::class,
            SupplierSeeder::class,
            BarangSeeder::class,
            UserSeeder::class, // Pastikan UserSeeder dijalankan sebelum StokSeeder
            PenjualanSeeder::class,
            PenjualanDetailSeeder::class,
            StokSeeder::class,
        ]);
    }
}
