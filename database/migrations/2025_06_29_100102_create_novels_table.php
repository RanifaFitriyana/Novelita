<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('image',)->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedBigInteger('category_id');
            $table->integer('stock')->default(0);
            $table->string('sku')->nullable();
            $table->integer('weight')->default(1);
            $table->unsignedBigInteger('hub_product_id')->nullable(); // untuk ID produk dari Hub UMKM
            $table->boolean('is_active')->default(true); 
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novels');
    }
};
