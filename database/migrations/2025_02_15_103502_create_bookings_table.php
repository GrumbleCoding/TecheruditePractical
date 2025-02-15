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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->date('booking_date')->nullable();
            $table->enum('booking_type', ['1', '2', '3'])->default('1')->index()->comment('1 = Full Day, 2 = Half Day, 3 = Custom');
            $table->enum('booking_slot', ['0', '1', '2'])->default('0')->index()->comment('1 = First Half, 2 = Second Half');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
