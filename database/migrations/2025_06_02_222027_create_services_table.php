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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->boolean('sectn_services')->default(0);
            $table->string('sectn_services_title')->nullable();
            $table->string('sectn_services_title_color', 10)->nullable();
            $table->string('sectn_header_bg_color', 10)->nullable();
            $table->boolean('sectn_someserv')->default(0);
            $table->boolean('sectn_servslogan')->default(0);
            $table->string('sloganimage')->nullable();
            $table->string('caption_title')->nullable();
            $table->string('slogan')->nullable();
            $table->string('slogan_bg_color', 10)->nullable();
            $table->string('caption_color', 10)->nullable();
            $table->string('slogan_color', 10)->nullable();

            $table->string('sectn_someserv_bg_color', 10)->nullable();
            $table->string('sectn_someserv_title_bg_color', 10)->nullable();
            $table->string('sectn_someserv_des_bg_color', 10)->nullable();

            $table->boolean('sectn_allserve')->default(0);
            $table->string('allserve_bg_color', 10)->nullable();

            $table->string('sectn_services_title_color_tw')->nullable();
            $table->string('sectn_header_bg_color_tw')->nullable();
            $table->string('sectn_someserv_bg_color_tw')->nullable();
            $table->string('slogan_bg_color_tw')->nullable();
            $table->string('caption_color_tw')->nullable();
            $table->string('slogan_color_tw')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
