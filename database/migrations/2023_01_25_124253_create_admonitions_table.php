<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmonitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admonitions', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_de_la_incidencia')->nullable();
            $table->enum('gravedad', ['Leve', 'Moderado', 'Grave', 'Muy grave'])->nullable();
            $table->longText('observaciones')->nullable();

            $table->unsignedBigInteger('amonestado_id')->nullable();
            $table->foreign('amonestado_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('solicitante_id')->nullable();
            $table->foreign('solicitante_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('alta_id')->nullable();
            $table->foreign('alta_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('admonition_type_id')->nullable();
            $table->foreign('admonition_type_id')->references('id')->on('admonition_types')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('admonitions');
    }
}
