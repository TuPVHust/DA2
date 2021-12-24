<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('schedule_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('cost_group_id')->unsigned()->nullable()->default(null);
            $table->float('cost');
            $table->float('actual_cost');
            $table->text('description')->nullable()->collation('utf8mb4_unicode_ci');
            $table->timestamps();
            $table->foreign('schedule_id')->references('id')->on('schedules')->default(null);
            $table->foreign('cost_group_id')->references('id')->on('cost_groups')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_details');
    }
}
