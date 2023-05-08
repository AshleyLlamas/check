<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{

    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->integer('posición')->nullable();

            $table->longText('día')->nullable();
            $table->time('hora_de_entrada')->nullable();
            $table->time('hora_de_salida')->nullable();

            $table->string('turno')->nullable();

            // $table->unsignedBigInteger('user_id')->nullable()->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('scheduleble_id');
            $table->string('scheduleble_type');

            $table->boolean('actual')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
