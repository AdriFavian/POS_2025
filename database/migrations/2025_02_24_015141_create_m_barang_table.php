<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id('barang_id'); // Primary Key

            // FK pada kolom kategori_id mengacu pada kolom kategori_id pada tabel m_kategori
            $table->unsignedBigInteger('kategori_id')->index();
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori');
            
            $table->string('barang_kode', 10)->unique(); // tidak boleh ada yang sama
            $table->string('barang_nama', 100);
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
