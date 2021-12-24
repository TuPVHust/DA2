<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('plate')->unique();
            $table->string('figure')->collation('utf8mb4_unicode_ci');
            $table->string('brand')->collation('utf8mb4_unicode_ci');
            $table->integer('capacity')->comment('đơn vị tấn');
            $table->bigInteger('owner_id')->unsigned()->nullable()->default(null);
            $table->foreign('owner_id')->references('id')->on('partners')->default(null);
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trucks');
    }
}
