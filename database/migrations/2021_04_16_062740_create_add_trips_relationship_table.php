<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTripsRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {            
            $table->foreign('from')->references('id')->on('cities')->onDelete('cascade');;
        });
        Schema::table('trips', function (Blueprint $table) {            
            $table->foreign('to')->references('id')->on('cities')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign(['from']);
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->bigInteger('from')->change();
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign(['to']);
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->bigInteger('to')->change();
        });
    }
}
