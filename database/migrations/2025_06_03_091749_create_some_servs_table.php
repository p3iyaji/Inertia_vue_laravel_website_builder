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
        Schema::create('some_servs', function (Blueprint $table) {
            $table->id();
            
            $table->string('sectn_someserv_title')->nullable();
            $table->string('sectn_someserv_title_color', 10)->nullable();

            $table->string('sectn_someserv_description')->nullable();
            $table->string('sectn_someserv_des_color', 10)->nullable();

            $table->string('someservimage')->nullable();

            $table->string('sectn_someserv_bg_color', 10)->nullable();
            $table->string('sectn_someserv_dark_bg_color', 10)->nullable();

            $table->string('sectn_someserv_title_color_tw')->nullable();
            $table->string('sectn_someserv_des_color_tw')->nullable();
            $table->string('sectn_someserv_bg_color_tw')->nullable();
            $table->string('sectn_someserv_dark_bg_color_tw')->nullable();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('some_servs');
    }
};
