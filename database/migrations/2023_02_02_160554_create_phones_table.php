<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();

            $table->string('plan')->nullable();
            $table->enum('sistema_operativo' ,['Android', 'iOS', 'Windows 10 Mobile', 'Symbian OS', 'Firefox OS', 'Ubuntu Touch','Harmony OS'])->nullable();
            $table->string('número_celular_o_extención')->nullable();
            $table->enum('tipo', ['Celular', 'Fijo']);

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
        Schema::dropIfExists('phones');
    }
}
