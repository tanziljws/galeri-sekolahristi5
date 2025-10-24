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
        Schema::table('posts', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['petugas_id']);
            
            // Re-add foreign key constraints with cascade delete
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop cascade foreign key constraints
            $table->dropForeign(['kategori_id']);
            $table->dropForeign(['petugas_id']);
            
            // Re-add original foreign key constraints without cascade
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('petugas_id')->references('id')->on('petugas');
        });
    }
};
