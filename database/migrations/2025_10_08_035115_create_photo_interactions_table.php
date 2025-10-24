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
        Schema::create('photo_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foto_id')->constrained('foto')->onDelete('cascade');
            $table->string('ip_address', 45); // Support both IPv4 and IPv6
            $table->enum('type', ['like', 'dislike']);
            $table->timestamps();
            
            // Ensure one interaction per IP per photo
            $table->unique(['foto_id', 'ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_interactions');
    }
};