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
        Schema::create('welcomes', function (Blueprint $table) {
            $table->id();
            $table->boolean('sectn_wwd')->default(0);
            $table->string('sectn_wwd_bg_color', 10)->nullable();
            $table->boolean('sectn_ccn')->default(0);
            $table->string('sectn_ccn_bg_color', 10)->nullable();
            $table->string('ccn_title')->nullable();
            $table->string('ccn_title_color', 10)->nullable();
            $table->string('ccn_description')->nullable();
            $table->string('ccn_description_color', 10)->nullable();
            $table->string('ccn_btn_title')->nullable();
            $table->string('btn_ccn_bg_color', 10)->nullable();
            $table->string('btn_ccn_text_color', 10)->nullable();

            $table->boolean('sectn_3_services')->default(0);
            // other parts in welcome serve relationship

            
            $table->boolean('sectn_oservices')->default(0);
            $table->string('sectn_oserv_bg_color', 10)->nullable();
            $table->string('sectn_oservdark_bg_color', 10)->nullable();
            // other parts in our services relationship
           

            $table->boolean('sectn_services')->default(0);
            $table->string('sectn_serv_title')->nullable();
            $table->string('sectn_serv_description')->nullable();
            $table->string('services_image')->nullable();
            $table->string('sectn_serv_bg_color', 10)->nullable();
            $table->string('sectn_serv_title_color', 10)->nullable();
            $table->string('sectn_serv_description_color', 10)->nullable();

            $table->boolean('sectn_client_logo')->default(0);
            $table->string('sectn_client_title')->nullable();
            $table->string('sectn_client_text_color', 10)->nullable();
            $table->string('sectn_client_bg_color', 10)->nullable();
            $table->string('sectn_dclient_text_color', 10)->nullable();
            $table->string('sectn_dclient_bg_color', 10)->nullable();
            
            // Tailwind classes
            $table->string('sectn_wwd_bg_color_tw')->nullable();
            $table->string('sect_ccn_bg_color_tw')->nullable();
            $table->string('ccn_title_color_tw')->nullable();
            $table->string('ccn_description_color_tw')->nullable();
            $table->string('btn_ccn_bg_color_tw')->nullable();
            $table->string('btn_ccn_text_color_tw')->nullable();



            $table->string('sectn_oserv_bg_color_tw', 10)->nullable();
            $table->string('sectn_oservdark_bg_color_tw', 10)->nullable();

            $table->string('sectn_serv_bg_color_tw')->nullable();
            $table->string('sectn_serv_title_color_tw')->nullable();
            $table->string('sectn_serv_description_color_tw')->nullable();
            $table->string('sectn_client_text_color_tw')->nullable();
            $table->string('sectn_client_bg_color_tw')->nullable();
            $table->string('sectn_dclient_text_color_tw')->nullable();
            $table->string('sectn_dclient_bg_color_tw')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcomes');
    }
};
