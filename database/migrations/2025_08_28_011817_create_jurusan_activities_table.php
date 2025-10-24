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
        Schema::create('jurusan_activities', function (Blueprint $table) {
            $table->id();
            $table->string('jurusan'); // PPLG, TJKT, TPFL, TO
            $table->string('title');
            $table->text('description');
            $table->string('image_path');
            $table->string('activity_type'); // lab, workshop, competition, project, etc.
            $table->date('activity_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusan_activities');
    }
};
