<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZktecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zktecos', function (Blueprint $table) {
            
            $table->id();
            $table->ipAddress('ip');
            $table->string('puerto',10);
            $table->string('nombre_del_modelo')->nullable();
            $table->string('dominio')->nullable();
            $table->tinyInteger('status')->default(0);                                                                                                              
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
        Schema::dropIfExists('zktecos');
    }
}
