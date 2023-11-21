<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTryOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('try_outs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('tier_id');
            $table->jsonb('day');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('duration');
            $table->boolean('status')->default(0);
            $table->foreign('tier_id')->references('id')->on('tiers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('try_outs');
    }
}
