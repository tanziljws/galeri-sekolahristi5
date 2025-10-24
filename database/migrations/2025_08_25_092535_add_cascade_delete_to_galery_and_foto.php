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
        // galery.post_id -> posts.id ON DELETE CASCADE
        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        // foto.galery_id -> galery.id ON DELETE CASCADE
        Schema::table('foto', function (Blueprint $table) {
            $table->dropForeign(['galery_id']);
            $table->foreign('galery_id')->references('id')->on('galery')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galery', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts');
        });

        Schema::table('foto', function (Blueprint $table) {
            $table->dropForeign(['galery_id']);
            $table->foreign('galery_id')->references('id')->on('galery');
        });
    }
};
