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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('type')->nullable();
            $table->string('material')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('price_1', 12, 2)->default(0);
            $table->decimal('price_2', 12, 2)->default(0);
            $table->decimal('price_3', 12, 2)->default(0);
            $table->decimal('price_4', 12, 2)->default(0);
            $table->decimal('current_stock', 12, 2)->default(0);
            $table->text('colors')->nullable();
            $table->text('compatibility')->nullable()->comment('VINs / Numéros de châssis');
            $table->string('image')->nullable();
            $table->json('images')->nullable()->comment('Galerie dimages supplémentaires');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_synced')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};