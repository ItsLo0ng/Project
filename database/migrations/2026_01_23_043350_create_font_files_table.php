<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('font_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('font_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('file_url', 500);
            $table->string('file_format', 20);
            $table->timestamps();

            $table->index('font_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('font_files');
    }
};