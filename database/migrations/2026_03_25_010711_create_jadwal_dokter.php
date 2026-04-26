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
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->nullable()->unique();
            $table->unsignedBigInteger('dokter_id')->nullable()->index();
            $table->unsignedBigInteger('poliklinik_id')->nullable()->index();

            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->string('ruangan_nama')->nullable();
            $table->string('kode_jadwal', 20)->nullable();

            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])->nullable()->index();
            $table->integer('hari_order')->default(0);

            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('tipe_pelayanan', 50)->nullable();

            $table->boolean('is_manual')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->enum('source', ['api', 'manual'])->default('api')->index();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['dokter_id', 'hari', 'jam_mulai', 'jam_selesai']);
            $table->index(['api_id', 'is_manual']);

            $table->foreign('dokter_id')->references('id')->on('dokter')->nullOnDelete();
            $table->foreign('poliklinik_id')->references('id')->on('poliklinik')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
