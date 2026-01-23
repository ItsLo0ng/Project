<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fonts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('category_id')
                  ->constrained('font_categories')
                  ->onDelete('restrict');
            $table->string('name', 200);
            $table->string('designer', 160)->nullable();
            $table->text('description')->nullable();
            $table->date('date_added');
            $table->timestamps();

            $table->index('user_id');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fonts');
    }
};