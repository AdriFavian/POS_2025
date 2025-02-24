<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $stokTanggal = now();

        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'stok_id' => $i,
                'supplier_id' => ceil($i / 5), //setiap 5 barang dari 1 supplier
                'barang_id' => $i,
                'user_id' => 1, //stok diinput oleh admin
                'stok_tanggal' => $stokTanggal,
                'stok_jumlah' => rand(10, 50),
            ];
        }

        DB::table('t_stok')->insert($data);
    }
}
