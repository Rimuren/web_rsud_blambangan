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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->nullable()->unique();
            $table->string('nama', 100)->index();
            $table->string('kode', 20)->nullable();
            $table->string('kode_bpjs', 20)->nullable();
            $table->string('spesialis', 150)->nullable()->index();
            $table->string('subspesialis', 150)->nullable()->index();
            $table->text('pendidikan')->nullable();
            $table->integer('umur')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('rating')->default(0);

            $table->boolean('is_manual')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->enum('source', ['api', 'manual'])->default('api')->index();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['api_id', 'is_manual', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
