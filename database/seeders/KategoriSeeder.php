<?php

namespace Database\Seeders;

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
            ['kategori_id' => 6, 'kategori_kode' => 'ELK', 'kategori_nama' => 'Elektronik'],
            ['kategori_id' => 7, 'kategori_kode' => 'FSH', 'kategori_nama' => 'Fashion'],
            ['kategori_id' => 8, 'kategori_kode' => 'MAK', 'kategori_nama' => 'Makanan'],
            ['kategori_id' => 9, 'kategori_kode' => 'MIN', 'kategori_nama' => 'Minuman'],
            ['kategori_id' => 10, 'kategori_kode' => 'MSK', 'kategori_nama' => 'Musik'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
