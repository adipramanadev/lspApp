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
        Schema::create('asesors', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 50)->nullable();
            $table->string('nama', 75)->nullable();
            // $table->string('image', 255)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('sex', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('skema', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesors');
    }
};
