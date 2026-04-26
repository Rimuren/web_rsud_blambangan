<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bangsal', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('api_id')->unique();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('bangsal_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('bangsal_id');
            $table->unsignedBigInteger('kelas_id');

            $table->integer('bed_kapasitas');
            $table->integer('bed_terisi');
            $table->integer('bed_kosong');

            $table->timestamps();

            // composite primary key
            $table->primary(['bangsal_id', 'kelas_id']);

            // foreign key
            $table->foreign('bangsal_id')->references('id')->on('bangsal')->cascadeOnDelete();
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bangsal_kelas');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('bangsal');
    }
};
