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
        Schema::create('all_serves', function (Blueprint $table) {
            $table->id();
            $table->string('allserve_title')->nullable();
            $table->string('allserve_description')->nullable();
            $table->string('allserve_image')->nullable();
            $table->string('allserve_title_color', 10)->nullable();
            $table->string('allserve_description_color', 10)->nullable();

            $table->string('allserve_title_color_tw')->nullable();
            $table->string('allserve_description_color_tw')->nullable();
            
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
        Schema::dropIfExists('all_serves');
    }
};
