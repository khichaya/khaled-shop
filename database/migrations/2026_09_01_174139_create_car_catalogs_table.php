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
        Schema::create('car_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('brand_logo')->nullable();
            $table->string('model');
            $table->string('model_image')->nullable();
            $table->string('years');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_catalogs');
    }
};
