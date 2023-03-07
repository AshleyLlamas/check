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

            $table->date('fecha')->nullable();
            $table->longText('observación')->nullable();
            $table->integer('horas')->nullable();

            $table->enum('estatus', ['No aprobado', 'Aprobado'])->nullable();

            //Quien creo la hora extra?
            $table->unsignedBigInteger('creador_id')->nullable();
            $table->foreign('creador_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            //De quien es la hora extra?
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            //Que asistencia contó la hr extra?
            $table->unsignedBigInteger('assistance_id')->nullable();
            $table->foreign('assistance_id')->references('id')->on('assistances')->onDelete('set null')->onUpdate('cascade');

            //Aprovaciones
            $table->unsignedBigInteger('approval_jefe_id')->nullable();
            $table->foreign('approval_jefe_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_rh_id')->nullable();
            $table->foreign('approval_rh_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_dg_id')->nullable();
            $table->foreign('approval_dg_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('extra_hours');
    }
}
