<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang dari Supplier 1
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Meja Makan', 'harga_beli' => 500000, 'harga_jual' => 700000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Meja Kerja', 'harga_beli' => 450000, 'harga_jual' => 600000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'BRG003', 'barang_nama' => 'Kursi Kantor', 'harga_beli' => 300000, 'harga_jual' => 450000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'BRG004', 'barang_nama' => 'Kursi Makan', 'harga_beli' => 250000, 'harga_jual' => 400000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'BRG005', 'barang_nama' => 'Lemari Pakaian', 'harga_beli' => 800000, 'harga_jual' => 1000000],

            // Barang dari Supplier 2
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'BRG006', 'barang_nama' => 'Lemari Buku', 'harga_beli' => 600000, 'harga_jual' => 800000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'BRG007', 'barang_nama' => 'Tempat Tidur Single', 'harga_beli' => 1000000, 'harga_jual' => 1300000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'BRG008', 'barang_nama' => 'Tempat Tidur Queen', 'harga_beli' => 1500000, 'harga_jual' => 1800000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'BRG009', 'barang_nama' => 'Rak Sepatu', 'harga_beli' => 200000, 'harga_jual' => 300000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'BRG010', 'barang_nama' => 'Rak Buku', 'harga_beli' => 350000, 'harga_jual' => 500000],

            // Barang dari Supplier 3
            ['barang_id' => 11, 'kategori_id' => 1, 'barang_kode' => 'BRG011', 'barang_nama' => 'Meja Rias', 'harga_beli' => 700000, 'harga_jual' => 900000],
            ['barang_id' => 12, 'kategori_id' => 2, 'barang_kode' => 'BRG012', 'barang_nama' => 'Kursi Teras', 'harga_beli' => 350000, 'harga_jual' => 500000],
            ['barang_id' => 13, 'kategori_id' => 3, 'barang_kode' => 'BRG013', 'barang_nama' => 'Lemari Dapur', 'harga_beli' => 850000, 'harga_jual' => 1100000],
            ['barang_id' => 14, 'kategori_id' => 4, 'barang_kode' => 'BRG014', 'barang_nama' => 'Tempat Tidur King', 'harga_beli' => 2000000, 'harga_jual' => 2300000],
            ['barang_id' => 15, 'kategori_id' => 5, 'barang_kode' => 'BRG015', 'barang_nama' => 'Rak TV', 'harga_beli' => 500000, 'harga_jual' => 700000],

            ['barang_id' => 16, 'kategori_id' => 6, 'barang_kode' => 'BRG016', 'barang_nama' => 'Laptop GEMING', 'harga_beli' => 500, 'harga_jual' => 4500000],
            ['barang_id' => 17, 'kategori_id' => 7, 'barang_kode' => 'BRG017', 'barang_nama' => 'Baju Kerajaan', 'harga_beli' => 3500, 'harga_jual' => 500000],
            ['barang_id' => 18, 'kategori_id' => 8, 'barang_kode' => 'BRG018', 'barang_nama' => 'Burger JUMBO', 'harga_beli' => 125000, 'harga_jual' => 225000],
            ['barang_id' => 19, 'kategori_id' => 9, 'barang_kode' => 'BRG019', 'barang_nama' => 'Soda Gembira', 'harga_beli' => 1750000, 'harga_jual' => 3500000],
            ['barang_id' => 20, 'kategori_id' => 10, 'barang_kode' => 'BRG020', 'barang_nama' => 'Gitar Van Hallen', 'harga_beli' => 1200, 'harga_jual' => 850000],
        ];

        DB::table('m_barang')->insert($data);
    }
}

