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
        Schema::table('galery', function (Blueprint $table) {
            $table->string('category', 50)->nullable()->after('status');
        });
        
        // Set default value for existing records
        DB::table('galery')->whereNull('category')->update(['category' => 'umum']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galery', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
