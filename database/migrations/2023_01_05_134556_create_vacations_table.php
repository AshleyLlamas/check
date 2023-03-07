<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();

            $table->string('motivo');

            $table->date('fecha_inicial');

            $table->date('fecha_final');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_jefe_id')->nullable();
            $table->foreign('approval_jefe_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_rh_id')->nullable();
            $table->foreign('approval_rh_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('approval_dg_id')->nullable();
            $table->foreign('approval_dg_id')->references('id')->on('approvals')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('estatus', ['En espera', 'Aprobado', 'No aprobado']);

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
        Schema::dropIfExists('vacations');
    }
}
