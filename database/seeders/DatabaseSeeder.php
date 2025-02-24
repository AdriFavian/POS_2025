<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            UserSeeder::class,
            BarangSeeder::class,
            PenjualanSeeder::class,
            StokSeeder::class,
            PenjualanDetailSeeder::class,
        ]);
    }
}
