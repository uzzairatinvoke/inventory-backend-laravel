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
        Schema::table('products', function (Blueprint $table) {
            $table->string('file_path')->nullable();
            $table->string('original_filename')->nullable();
            $table->string('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('storage_disk')->default('r2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('file_path');
            $table->dropColumn('original_filename');
            $table->dropColumn('file_size');
            $table->dropColumn('mime_type');
            $table->dropColumn('storage_disk');
        });
    }
};
