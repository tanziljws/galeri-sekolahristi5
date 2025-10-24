<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop foreign key constraint first
        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
        
        // Make post_id nullable
        DB::statement('ALTER TABLE galery MODIFY post_id INTEGER NULL');
        
        // Add back foreign key with nullable
        Schema::table('galery', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key
        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
        
        // Make post_id not nullable again
        DB::statement('ALTER TABLE galery MODIFY post_id INTEGER NOT NULL');
        
        // Add back foreign key
        Schema::table('galery', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }
};
