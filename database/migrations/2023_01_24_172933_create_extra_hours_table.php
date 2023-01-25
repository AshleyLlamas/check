<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_hours', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('assistance_id')->nullable();
            $table->foreign('assistance_id')->references('id')->on('assistances')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('horas_extra')->nullable();

            $table->unsignedBigInteger('approval_jefe_id')->nullable();
            $table->foreign('approval_jefe_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_rh_id')->nullable();
            $table->foreign('approval_rh_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_dg_id')->nullable();
            $table->foreign('approval_dg_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('extra_hours');
    }
}
