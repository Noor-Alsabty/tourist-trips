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
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
			$table->bigInteger('trip_id')->unsigned();
			// $table->bigInteger('payment_id')->unsigned();
			$table->string('customer_name');
			$table->string('customer_email');
			$table->integer('number_of_people');
            $table->enum('status', [ 'confirmed', 'cancelled'])->default('confirmed');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
