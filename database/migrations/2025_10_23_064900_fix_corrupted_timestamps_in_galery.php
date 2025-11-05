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
        // Add judul column if it doesn't exist
        if (!Schema::hasColumn('galery', 'judul')) {
            Schema::table('galery', function (Blueprint $table) {
                $table->string('judul')->nullable()->after('post_id');
            });
        }
        
        // Fix corrupted timestamps in galery table (MySQL/MariaDB syntax)
        // Some records have 'umum' or other string values in created_at/updated_at columns
        try {
            DB::statement("UPDATE galery SET created_at = NOW() WHERE created_at IS NULL OR created_at = ''");
            DB::statement("UPDATE galery SET updated_at = NOW() WHERE updated_at IS NULL OR updated_at = ''");
            
            // Log the fix
            \Log::info('Fixed corrupted timestamps and added judul column in galery table');
        } catch (\Exception $e) {
            // If timestamp fix fails, just continue - not critical
            \Log::warning('Could not fix timestamps: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop judul column if exists
        if (Schema::hasColumn('galery', 'judul')) {
            Schema::table('galery', function (Blueprint $table) {
                $table->dropColumn('judul');
            });
        }
        
        // Cannot reverse timestamp fixes as we don't know the original corrupted values
    }
};
