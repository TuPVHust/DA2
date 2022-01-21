<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('description')->nullable()->collation('utf8mb4_unicode_ci');
            $table->bigInteger('driver_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('truck_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('car_owner_id')->unsigned()->nullable()->default(null);
            $table->timestamp('date', $precision = 0);
            $table->tinyInteger('shift');
            $table->tinyInteger('status')->default(1);
            $table->double('init_money');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->foreign('car_owner_id')->references('id')->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
