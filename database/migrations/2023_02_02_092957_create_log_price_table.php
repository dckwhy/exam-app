<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_prices', function (Blueprint $table) {
            $table->id();
            $table->string('old_price');
            $table->string('new_price');
            $table->string('reason');
            $table->unsignedBigInteger('tier_id');
            $table->foreign('tier_id')->references('id')->on('tiers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_prices');
    }
}
