<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');
            $table->string('name', 120)->nullable();
            $table->string('email', 255);
            $table->string('subject', 150)->nullable();
            $table->text('message');
            $table->dateTime('date_sent');
            $table->string('status', 30)->default('pending');
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};