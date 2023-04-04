<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id')->nullable(); //DE QUE COMPAÑIA ES
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null')->onUpdate('cascade'); //DE QUE COMPAÑIA ES

            $table->longText('descripción')->nullable();
            $table->date('fecha_de_adquisición')->nullable();
            $table->string('qr')->nullable();

            $table->unsignedBigInteger('inventariable_id')->nullable();
            $table->string('inventariable_type')->nullable();

            $table->unsignedBigInteger('propietariable_id')->nullable();//DE QUIEN O DE DONDE ES?
            $table->string('propietariable_type')->nullable();//DE QUIEN O DE DONDE ES?

            $table->string('garantia')->nullable(); //IMAGEN
            $table->string('factura')->nullable(); //IMAGEN

            $table->enum('arrendado', ['No', 'Si'])->default('No');

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
        Schema::dropIfExists('inventories');
    }
}
