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
        Schema::create('activities', function (Blueprint $table) {
        $table->increments('id');
			$table->integer('trip_id')->unsigned();
$table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
			$table->string('name');
            $table->string('description');
			$table->time('start_time');
            $table->time('end_time');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
