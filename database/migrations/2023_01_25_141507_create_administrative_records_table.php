<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrative_records', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('colaborador_id')->nullable();
            $table->foreign('colaborador_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('tipo_de_amonestación', ['Verbal', 'Escrito', 'Suspensión'])->nullable();
            $table->longText('comentarios_del_colaborador')->nullable();
            $table->longText('observaciones')->nullable();
            $table->date('fecha_de_ausencia')->nullable();
            $table->date('fecha_de_suspencion')->nullable();

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
        Schema::dropIfExists('administrative_records');
    }
}
