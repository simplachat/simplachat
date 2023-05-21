<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

			// category_id and shop_id
			$table->foreignId('category_id')->constrained()->onDelete('cascade');
			$table->foreignId('shop_id')->constrained()->onDelete('cascade');

			// barcode, name, slug, description, images, details
			$table->string('barcode', 13)->unique();
            $table->string('name', 255);
			$table->string('slug', 255)->unique();
            $table->text('description');
			$table->text('images');
			$table->text('details');

			// stock
			$table->integer('stock');

			// unit_price, discount, discount_price, lower_price, vat
			$table->float('unit_price');
			$table->float('discount')->nullable();
            $table->float('discount_price')->nullable();
			$table->float('lower_price')->nullable();
			$table->float('vat');

			// timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
