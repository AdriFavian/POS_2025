<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $detailId = 1;

        for ($penjualanId = 1; $penjualanId <= 10; $penjualanId++) {
            $barangIds = array_rand(range(1, 15), 3); //random 3 barang untuk setiap transaksi

            foreach ($barangIds as $barangId) {
                $harga = DB::table('m_barang')->where('barang_id', $barangId + 1)->value('harga_jual');
                $data[] = [
                    'detail_id' => $detailId++,
                    'penjualan_id' => $penjualanId,
                    'barang_id' => $barangId + 1,
                    'harga' => $harga,
                    'jumlah' => rand(1, 5),
                ];
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}
