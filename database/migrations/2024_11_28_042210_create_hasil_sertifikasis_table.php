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
        Schema::create('hasil_sertifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('pesertas')->onDelete('cascade');
            $table->foreignId('schema_id')->constrained('schemas')->onDelete('cascade');
            $table->enum('status', ['Lulus', 'Tidak Lulus'])->nullable();
            $table->date('tanggal_sertifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_sertifikasis');
    }
};
