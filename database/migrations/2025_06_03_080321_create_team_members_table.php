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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('team_mem_name')->nullable();
            $table->string('team_mem_position')->nullable();
            $table->string('team_mem_description')->nullable();
            $table->string('team_mem_image')->nullable();
            $table->string('team_mem_name_color', 10)->nullable();
            $table->string('team_mem_position_color', 10)->nullable();
            $table->string('team_mem_description_color', 10)->nullable();
            $table->string('team_mem_bg_color', 10)->nullable();

            $table->string('team_mem_name_color_tw')->nullable();
            $table->string('team_mem_position_color_tw')->nullable();
            $table->string('team_mem_description_color_tw')->nullable();
            $table->string('team_mem_bg_color_tw')->nullable();
            $table->unsignedBigInteger('team_mem_id');
            $table->foreign('team_mem_id')->references('id')->on('abouts')->onDelete('cascade');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
