<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'SUP01', 'supplier_nama' => 'PT Furnitur Jaya', 'supplier_alamat' => 'Jl. Kayu No.1, Malang'],
            ['supplier_id' => 2, 'supplier_kode' => 'SUP02', 'supplier_nama' => 'CV Mebel Indah', 'supplier_alamat' => 'Jl. Furnitur No.2, Surabaya'],
            ['supplier_id' => 3, 'supplier_kode' => 'SUP03', 'supplier_nama' => 'UD Interior Makmur', 'supplier_alamat' => 'Jl. Perabot No.3, Jakarta'],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
