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

            $table->unsignedBigInteger('admonition_type_id')->nullable();
            $table->foreign('admonition_type_id')->references('id')->on('admonition_types')->onDelete('set null')->onUpdate('cascade');

            $table->string('comentarios_del_colaborador')->nullable();
            $table->longText('observaciones')->nullable();
            $table->date('fecha_del_permiso')->nullable();
            $table->enum('categoria_del_permiso', ['Día de ausencia', 'Fecha de suspención'])->nullable();

            $table->unsignedBigInteger('alta_id')->nullable();
            $table->foreign('alta_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('administrative_records');
    }
}
