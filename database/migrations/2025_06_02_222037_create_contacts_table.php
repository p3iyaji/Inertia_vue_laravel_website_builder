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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('src')->nullable();
            $table->boolean('main_section')->default(0);
            $table->string('office_block_bg_color', 10)->nullable();
            $table->string('office_title')->nullable();
            $table->string('office_title_color', 10)->nullable();
            $table->string('address')->nullable();
            $table->string('address_color', 10)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('email_color', 10)->nullable();
            $table->string('phone_color', 10)->nullable();

            $table->string('office_block_bg_color_tw', 10)->nullable();
            $table->string('office_title_color_tw', 10)->nullable();
            $table->string('email_color_tw', 10)->nullable();
            $table->string('phone_color_tw', 10)->nullable();
            $table->string('address_color_tw', 10)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
