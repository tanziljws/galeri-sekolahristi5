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
        // Fix corrupted timestamps in galery table
        // Some records have 'umum' or other string values in created_at/updated_at columns
        
        DB::statement("UPDATE galery SET created_at = datetime('now') WHERE created_at IS NULL OR created_at = '' OR created_at NOT LIKE '____-__-__ __:__:__'");
        DB::statement("UPDATE galery SET updated_at = datetime('now') WHERE updated_at IS NULL OR updated_at = '' OR updated_at NOT LIKE '____-__-__ __:__:__'");
        
        // Log the fix
        \Log::info('Fixed corrupted timestamps in galery table');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse this migration as we don't know the original corrupted values
    }
};
