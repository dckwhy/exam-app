<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('phone');
            $table->text('address');
            $table->string('school_origin');
            $table->unsignedBigInteger('oldster_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('oldster_id')->references('id')->on('oldsters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('students');
    }
}
