<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustifyAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justify_attendances', function (Blueprint $table) {
            $table->id();

            $table->string('tipo');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('assistance_id')->nullable();
            $table->foreign('assistance_id')->references('id')->on('assistances')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_jefe_id')->nullable();
            $table->foreign('approval_jefe_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_rh_id')->nullable();
            $table->foreign('approval_rh_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('estatus', ['En espera', 'Aprobado', 'No aprobado']);


            //agregar tabla aprobación

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justify_attendances');
    }
}
