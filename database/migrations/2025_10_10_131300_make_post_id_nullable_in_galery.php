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
        // Check if judul column already exists
        if (!Schema::hasColumn('galery', 'judul')) {
            // Drop foreign key constraint first if exists
            try {
                Schema::table('galery', function (Blueprint $table) {
                    $table->dropForeign(['post_id']);
                });
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }
            
            // Make post_id nullable
            DB::statement('ALTER TABLE galery MODIFY post_id BIGINT UNSIGNED NULL');
            
            // Add judul column
            Schema::table('galery', function (Blueprint $table) {
                $table->string('judul')->nullable()->after('post_id');
            });
            
            // Add back foreign key with nullable
            try {
                Schema::table('galery', function (Blueprint $table) {
                    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Foreign key might already exist, continue
            }
        }
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
        
        // Drop judul column
        Schema::table('galery', function (Blueprint $table) {
            $table->dropColumn('judul');
        });
        
        // Make post_id not nullable again
        DB::statement('ALTER TABLE galery MODIFY post_id INTEGER NOT NULL');
        
        // Add back foreign key
        Schema::table('galery', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }
};
