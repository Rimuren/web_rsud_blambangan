<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('link'); // URL YouTube
            $table->string('youtube_id')->unique(); // ID video dari YouTube
            $table->string('thumbnail')->nullable(); // URL thumbnail
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};