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
        Schema::create('mivis', function (Blueprint $table) {
            $table->id();
            $table->string('mission_title')->nullable();
            $table->string('mission_title_color', 10)->nullable();
            $table->string('mission_description')->nullable();
            $table->string('mission_description_color', 10)->nullable();
            $table->string('mission_title_color_tw')->nullable();
            $table->string('mission_description_color_tw')->nullable();
            $table->string('vision_title')->nullable();
            $table->string('vision_title_color', 10)->nullable();
            $table->string('vision_description')->nullable();
            $table->string('vision_description_color', 10)->nullable();
            $table->string('vision_title_color_tw')->nullable();
            $table->string('vision_description_color_tw')->nullable();

            $table->foreignId('about_id')->references('id')->on('abouts')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mivis');
    }
};
