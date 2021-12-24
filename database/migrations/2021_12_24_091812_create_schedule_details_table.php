<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('schedule_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('seller_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('buyer_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('category_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('order_id')->unsigned()->nullable()->default(null);
            $table->float('price');
            $table->float('actual_price');
            $table->float('revenue');
            $table->float('actual_revenue');
            $table->text('description')->nullable()->collation('utf8mb4_unicode_ci');
            $table->float('distance');
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('schedules')->default(null);
            $table->foreign('seller_id')->references('id')->on('partners')->default(null);
            $table->foreign('buyer_id')->references('id')->on('partners')->default(null);
            $table->foreign('category_id')->references('id')->on('categories')->default(null);
            $table->foreign('order_id')->references('id')->on('orders')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_details');
    }
}
