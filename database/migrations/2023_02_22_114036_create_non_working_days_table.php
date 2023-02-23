<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_working_days', function (Blueprint $table) {
            $table->id();

            $table->date('fecha')->nullable();
            $table->enum('sueldo', ['Sin gose', 'Con gose'])->nullable();
            $table->integer('multiplicador')->nullable();

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
        Schema::dropIfExists('non_working_days');
    }
}
