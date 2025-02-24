<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $tanggalAwal = now()->subDays(10);

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'penjualan_id' => $i,
                'user_id' => rand(2, 3), // penjualan oleh manager/staff
                'pembeli' => 'Pembeli ' . $i,
                'penjualan_kode' => 'PNJ' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'penjualan_tanggal' => $tanggalAwal->addDay()->toDateTimeString(),
            ];
        }

        DB::table('t_penjualan')->insert($data);
    }
}
