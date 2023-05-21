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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();

			// name, slug, phone, email, password
            $table->string('name', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->string('phone', 255);
            $table->string('email', 255)->unique();
			$table->string('password');

			// description, image
			$table->text('description');
            $table->text('image');

			// address, city, postalCode
			$table->text('address');
            $table->string('city', 255);
            $table->string('postalCode', 5);

			// is_banned, is_verified
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_verified')->default(false);

			// remember_token
			$table->rememberToken();

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
        Schema::dropIfExists('shops');
    }
};
