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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 50)->unique();
            $table->string('nama', 100);
            $table->string('alamat', 150);
            $table->enum('sex', ['Laki-laki', 'Perempuan']);
            $table->string('email', 100)->unique();
            $table->string('no_hp', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
