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
        // Check if category column already exists
        if (Schema::hasColumn('galery', 'category')) {
            // Modify existing category column to be nullable with max 50 chars
            DB::statement('ALTER TABLE galery MODIFY category VARCHAR(50) NULL');
        } else {
            // Add category column if it doesn't exist
            Schema::table('galery', function (Blueprint $table) {
                $table->string('category', 50)->nullable()->after('status');
            });
        }
        
        // Set default value for existing records that might be null
        DB::table('galery')->whereNull('category')->update(['category' => 'umum']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if column exists
        if (Schema::hasColumn('galery', 'category')) {
            Schema::table('galery', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }
};
