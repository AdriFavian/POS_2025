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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id');

            // FK pada kolom level_id mengacu pada kolom level_id pada tabel m_level
            $table->unsignedBigInteger('level_id')->index(); // FK
            $table->foreign('level_id')->references('level_id')->on('m_level');
            
            $table->string('username', 20)->unique(); // tidak boleh ada yang sama
            $table->string('nama', 100);
            $table->string('password');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
