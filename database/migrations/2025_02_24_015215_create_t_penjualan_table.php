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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id');//PK

            // FK pada kolom user_id mengacu pada kolom user_id pada tabel m_user
            $table->unsignedBigInteger('user_id')->index();
            
            $table->string('pembeli', 50);//tidak boleh ada yang sama
            $table->string('penjualan_kode', 20)->unique();//tidak boleh ada yang sama
            $table->dateTime('penjualan_tanggal');//
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('m_user');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};
