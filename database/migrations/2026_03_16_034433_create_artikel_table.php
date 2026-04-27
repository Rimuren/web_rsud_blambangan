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
        Schema::create('kategori_artikel', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 100);
            $table->string('slug', 100)->unique();
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });

        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('penulis_id');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_artikel')->onDelete('restrict');
            $table->foreign('penulis_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('kategori_artikel');
    }
};
