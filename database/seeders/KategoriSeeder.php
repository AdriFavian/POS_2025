<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'KTG01', 'kategori_nama' => 'Meja'],
            ['kategori_id' => 2, 'kategori_kode' => 'KTG02', 'kategori_nama' => 'Kursi'],
            ['kategori_id' => 3, 'kategori_kode' => 'KTG03', 'kategori_nama' => 'Lemari'],
            ['kategori_id' => 4, 'kategori_kode' => 'KTG04', 'kategori_nama' => 'Tempat Tidur'],
            ['kategori_id' => 5, 'kategori_kode' => 'KTG05', 'kategori_nama' => 'Rak'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
