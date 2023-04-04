<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();

            $table->string('documento_de_identificación_oficial')->nullable();
            $table->string('documento_del_comprobante_de_domicilio')->nullable();
            $table->string('documento_de_no_antecedentes_penales')->nullable();
            $table->string('documento_de_la_licencia_de_conducir')->nullable();
            $table->string('documento_de_la_cedula_profesional')->nullable();
            $table->string('documento_de_la_carta_de_pasante')->nullable();
            $table->string('documento_del_curriculum_vitae')->nullable();
            $table->string('documento_del_contrato')->nullable();

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
        Schema::dropIfExists('user_documents');
    }
}
