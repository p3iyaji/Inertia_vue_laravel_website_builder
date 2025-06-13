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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->boolean('sectn_header')->default(0);
            $table->string('sectn_header_title')->nullable();
            $table->string('sectn_header_title_color', 10)->nullable();
            $table->longtext('sectn_header_description')->nullable();
            $table->string('sectn_header_description_color', 10)->nullable();
            $table->string('sectn_header_bg_color', 10)->nullable();

            $table->boolean('sectn_mivi')->default(0);


            $table->boolean('sectn_slogan')->default(0);
            $table->longtext('sectn_slogan_caption')->nullable();
            $table->longtext('sectn_slogan_subcaption')->nullable();
            $table->string('slogan_image')->nullable();
            $table->string('sectn_slogan_caption_color', 10)->nullable();
            $table->string('sectn_slogan_bg_color', 10)->nullable();
            $table->string('sectn_slogan_subcaption_color', 10)->nullable();

            $table->boolean('sectn_team')->default(0);
            $table->string('team_title')->nullable();
            $table->longtext('team_caption')->nullable();
            $table->string('team_title_color', 10)->nullable();
            $table->string('team_caption_color', 10)->nullable();
            $table->string('team_bg_color', 10)->nullable();

            $table->boolean('sectn_team_mem')->default(0);


            $table->string('sectn_header_title_color_tw')->nullable();
            $table->string('sectn_header_description_color_tw')->nullable();
            $table->string('sectn_header_bg_color_tw')->nullable();
            $table->string('sectn_slogan_caption_color_tw')->nullable();
            $table->string('sectn_slogan_bg_color_tw')->nullable();
            $table->string('sectn_slogan_subcaption_color_tw')->nullable();
            $table->string('team_title_color_tw')->nullable();
            $table->string('team_caption_color_tw')->nullable();
            $table->string('team_bg_color_tw')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
