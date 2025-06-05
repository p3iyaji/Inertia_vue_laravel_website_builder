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
        Schema::create('welcome_serves', function (Blueprint $table) {
            $table->id();
            $table->string('sectn_3_title')->nullable();
            $table->string('sectn_3_title_color', 10)->nullable();
            $table->string('sectn_3ghover_title_color', 10)->nullable();
            $table->string('sectn_3darkghover_title_color', 10)->nullable();
            $table->string('sectn_3_bg_color', 10)->nullable();
            $table->string('sectn_3_dark_bg_color', 10)->nullable();

            $table->string('sectn_3_description')->nullable();
            $table->string('sectn_3_description_color', 10)->nullable();
            $table->string('sectn_3ghover_description_color', 10)->nullable();
            $table->string('sectn_3dark_description_color', 10)->nullable();
            $table->string('sectn_3darkhover_description_color', 10)->nullable();
            $table->unsignedBigInteger('welcome_id');
            $table->foreign('welcome_id')->references('id')->on('welcomes')->onDelete('cascade');
            
            $table->string('sectn_3_description_color_tw')->nullable();
            $table->string('sectn_3_title_color_tw')->nullable();
            $table->string('sectn_3ghover_title_color_tw')->nullable();
            $table->string('sectn_3darkghover_title_color_tw')->nullable();
            $table->string('sectn_3ghover_description_color_tw', 10)->nullable();
            $table->string('sectn_3dark_description_color_tw', 10)->nullable();
            $table->string('sectn_3darkhover_description_color_tw', 10)->nullable();
            $table->string('sectn_3_bg_color_tw')->nullable();
            $table->string('sectn_3_dark_bg_color_tw')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcome_serves');
    }
};
