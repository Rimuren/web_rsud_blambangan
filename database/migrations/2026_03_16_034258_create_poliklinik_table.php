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
        Schema::create('poliklinik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->nullable()->unique();
            $table->string('nama', 100)->index();
            $table->string('slug')->nullable()->unique();
            $table->string('kode_bpjs', 20)->nullable();
            $table->string('image')->nullable();
            $table->string('background_img')->nullable();
            $table->integer('tarif_konsultasi')->default(0);
            $table->integer('jumlah_dokter')->default(0);

            $table->boolean('senin')->default(false);
            $table->boolean('selasa')->default(false);
            $table->boolean('rabu')->default(false);
            $table->boolean('kamis')->default(false);
            $table->boolean('jumat')->default(false);
            $table->boolean('sabtu')->default(false);
            $table->boolean('minggu')->default(false);

            $table->boolean('is_active')->default(true)->index();
            $table->enum('source', ['api', 'manual'])->default('api')->index();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['api_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poliklinik');
    }
};
