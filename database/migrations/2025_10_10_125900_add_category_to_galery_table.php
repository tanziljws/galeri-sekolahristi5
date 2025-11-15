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
        if (!Schema::hasColumn('galery', 'category')) {
            // Add category column if it doesn't exist
            Schema::table('galery', function (Blueprint $table) {
                $driver = DB::getDriverName();
                
                // SQLite doesn't support 'after' clause
                if ($driver === 'sqlite') {
                    $table->string('category', 50)->nullable();
                } else {
                $table->string('category', 50)->nullable()->after('status');
                }
            });
        } else {
            // Column already exists - only modify if using MySQL/PostgreSQL
            // SQLite doesn't support MODIFY, so we skip modification for SQLite
            $driver = DB::getDriverName();
            
            if (in_array($driver, ['mysql', 'pgsql'])) {
                try {
                    if ($driver === 'mysql') {
                        DB::statement('ALTER TABLE galery MODIFY category VARCHAR(50) NULL');
                    } elseif ($driver === 'pgsql') {
                        DB::statement('ALTER TABLE galery ALTER COLUMN category TYPE VARCHAR(50), ALTER COLUMN category DROP NOT NULL');
                    }
                } catch (\Exception $e) {
                    // If modification fails, continue - column already exists
                }
            }
        }
        
        // Set default value for existing records that might be null
        try {
        DB::table('galery')->whereNull('category')->update(['category' => 'umum']);
        } catch (\Exception $e) {
            // Ignore if update fails
        }
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
