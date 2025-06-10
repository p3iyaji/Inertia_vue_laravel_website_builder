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
        Schema::create('welcome_our_servs', function (Blueprint $table) {
            $table->id();
            $table->string('sectn_oserv_title')->nullable();
            $table->string('sectn_oserv_bg_color', 10)->nullable();
            $table->string('sectn_oservdark_bg_color', 10)->nullable();
            $table->string('sectn_oservh_bg_color', 10)->nullable();
            $table->string('sectn_oservhd_bg_color', 10)->nullable();

            $table->string('sectn_oserv_title_color', 10)->nullable();
            $table->string('sectn_oservdark_title_color', 10)->nullable();
            $table->string('sectn_oservhover_title_color', 10)->nullable();
            $table->string('sectn_oservdarkhover_title_color', 10)->nullable();

            $table->string('sectn_oserv_description')->nullable();
            $table->string('sectn_oserv_description_color', 10)->nullable();
            $table->string('sectn_oservh_description_color', 10)->nullable();
            $table->string('sectn_oservd_description_color', 10)->nullable();
            $table->string('sectn_oservdh_description_color', 10)->nullable();

            $table->string('sectn_oservh_bg_color_tw')->nullable();
            $table->string('sectn_oservhd_bg_color_tw')->nullable();
            $table->string('sectn_oserv_title_color_tw')->nullable();
            $table->string('sectn_oservdark_bg_color_tw')->nullable();
            $table->string('sectn_oservdark_title_color_tw')->nullable();
            $table->string('sectn_oservhover_title_color_tw')->nullable();
            $table->string('sectn_oservdarkhover_title_color_tw')->nullable();
            $table->string('sectn_oserv_description_color_tw')->nullable();
            $table->string('sectn_oservh_description_color_tw')->nullable();
            $table->string('sectn_oservd_description_color_tw')->nullable();
            $table->string('sectn_oservdh_description_color_tw')->nullable();
            $table->unsignedBigInteger('welcome_id');
            $table->foreign('welcome_id')->references('id')->on('welcomes')->onDelete('cascade');

           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcome_our_servs');
    }
};
