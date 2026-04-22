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
        Schema::create('photo', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar');
            $table->text('deskripsi')->nullable();
            $table->string('kategori');
            $table->timestamps();
        });

        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('link');
            $table->string('youtube_id')->unique();
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo');
        Schema::dropIfExists('video');    
    }
};
