<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();

            $table->string('ram')->nullable();
            $table->string('procesador')->nullable();
            $table->string('targeta_gráfica')->nullable();
            $table->enum('tipo', ['Desktop', 'Laptop'])->nullable();
            $table->string('sistema_operativo')->nullable();

            $table->string('resguardo')->nullable();

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
        Schema::dropIfExists('computers');
    }
}
