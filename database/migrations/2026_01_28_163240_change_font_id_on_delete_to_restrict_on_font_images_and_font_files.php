<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // For font_images
        Schema::table('font_images', function (Blueprint $table) {
            // Drop the old foreign key
            $table->dropForeign(['font_id']);

            // Add new foreign key without CASCADE
            $table->foreign('font_id')
                  ->references('id')
                  ->on('fonts')
                  ->onDelete('restrict');  // Prevent deletion of parent if children exist
                  // OR use ->onDelete('set null') if you want font_id to become NULL
        });

        // Repeat for font_files (if you have the same issue there)
        Schema::table('font_files', function (Blueprint $table) {
            $table->dropForeign(['font_id']);
            $table->foreign('font_id')
                  ->references('id')
                  ->on('fonts')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        // Revert to CASCADE if you ever need to rollback
        Schema::table('font_images', function (Blueprint $table) {
            $table->dropForeign(['font_id']);
            $table->foreign('font_id')->references('id')->on('fonts')->onDelete('cascade');
        });

        Schema::table('font_files', function (Blueprint $table) {
            $table->dropForeign(['font_id']);
            $table->foreign('font_id')->references('id')->on('fonts')->onDelete('cascade');
        });
    }
};