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
        $driver = DB::getDriverName();
        
        Schema::table('photo_comments', function (Blueprint $table) use ($driver) {
            // Add user_id if not exists
            if (!Schema::hasColumn('photo_comments', 'user_id')) {
                if ($driver === 'sqlite') {
                    $table->unsignedBigInteger('user_id')->nullable();
                } else {
                    $table->unsignedBigInteger('user_id')->nullable()->after('foto_id');
                }
            }
            
            // Add parent_id if not exists
            if (!Schema::hasColumn('photo_comments', 'parent_id')) {
                if ($driver === 'sqlite') {
                    $table->unsignedBigInteger('parent_id')->nullable();
                } else {
                    $table->unsignedBigInteger('parent_id')->nullable()->after('user_id');
                }
            }
        });
        
        // Add foreign keys only for MySQL/PostgreSQL (SQLite handles differently)
        if (in_array($driver, ['mysql', 'pgsql'])) {
            try {
                Schema::table('photo_comments', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                    $table->foreign('parent_id')->references('id')->on('photo_comments')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Foreign keys might already exist
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();
        
        if (in_array($driver, ['mysql', 'pgsql'])) {
            Schema::table('photo_comments', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['parent_id']);
            });
        }
        
        Schema::table('photo_comments', function (Blueprint $table) {
            if (Schema::hasColumn('photo_comments', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
            if (Schema::hasColumn('photo_comments', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
