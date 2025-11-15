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
            $driver = DB::getDriverName();
            
            // Drop foreign key constraint first if exists (only for MySQL/PostgreSQL)
            if (in_array($driver, ['mysql', 'pgsql'])) {
            try {
                Schema::table('galery', function (Blueprint $table) {
                    $table->dropForeign(['post_id']);
                });
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }
            
                // Make post_id nullable (only for MySQL/PostgreSQL)
                try {
                    if ($driver === 'mysql') {
            DB::statement('ALTER TABLE galery MODIFY post_id BIGINT UNSIGNED NULL');
                    } elseif ($driver === 'pgsql') {
                        DB::statement('ALTER TABLE galery ALTER COLUMN post_id DROP NOT NULL');
                    }
                } catch (\Exception $e) {
                    // If modification fails, continue
                }
            }
            
            // Add judul column
            Schema::table('galery', function (Blueprint $table) use ($driver) {
                // SQLite doesn't support 'after' clause
                if ($driver === 'sqlite') {
                    $table->string('judul')->nullable();
                } else {
                $table->string('judul')->nullable()->after('post_id');
                }
            });
            
            // Add back foreign key with nullable (only for MySQL/PostgreSQL)
            if (in_array($driver, ['mysql', 'pgsql'])) {
            try {
                Schema::table('galery', function (Blueprint $table) {
                    $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Foreign key might already exist, continue
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();
        
        // Drop foreign key (only for MySQL/PostgreSQL)
        if (in_array($driver, ['mysql', 'pgsql'])) {
            try {
        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }
        }
        
        // Drop judul column
        if (Schema::hasColumn('galery', 'judul')) {
        Schema::table('galery', function (Blueprint $table) {
            $table->dropColumn('judul');
        });
        }
        
        // Make post_id not nullable again (only for MySQL/PostgreSQL)
        if (in_array($driver, ['mysql', 'pgsql'])) {
            try {
                if ($driver === 'mysql') {
        DB::statement('ALTER TABLE galery MODIFY post_id INTEGER NOT NULL');
                } elseif ($driver === 'pgsql') {
                    DB::statement('ALTER TABLE galery ALTER COLUMN post_id SET NOT NULL');
                }
            } catch (\Exception $e) {
                // If modification fails, continue
            }
        
        // Add back foreign key
            try {
        Schema::table('galery', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
        });
            } catch (\Exception $e) {
                // Foreign key might already exist, continue
            }
        }
    }
};
