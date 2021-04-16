<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddBookingRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {            
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');;
        });
        Schema::table('bookings', function (Blueprint $table) {            
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');;
        });
        Schema::table('bookings', function (Blueprint $table) {            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->bigInteger('user_id')->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['trip_id']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->bigInteger('trip_id')->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['seat_id']);
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->bigInteger('seat_id')->change();
        });
    }
}
