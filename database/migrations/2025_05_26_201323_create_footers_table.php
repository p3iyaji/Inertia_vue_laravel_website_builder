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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->integer('year');
            
            // Hex values
            $table->string('bg_color', 7);
            $table->string('text_color', 7);
            $table->string('dark_bg_color', 7);
            $table->string('dark_text_color', 7);
            
            // Tailwind classes
            $table->string('bg_color_tw')->nullable();
            $table->string('text_color_tw')->nullable();
            $table->string('dark_bg_color_tw')->nullable();
            $table->string('dark_text_color_tw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
