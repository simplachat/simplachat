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
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

			// user_id and shop_id
            $table->foreignId('user_id')->constrained('users');
			$table->foreignId('shop_id')->nullable()->constrained('shops');

			// order_number, is_basket, total, status_id
            $table->string('order_number', 12)->unique()->nullable();
            $table->boolean('is_basket')->default(true);
            $table->float('total', unsigned: true);
            $table->foreignId('status_id')->constrained('order_statuses');

			// timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
