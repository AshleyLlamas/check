<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->nullable();
            $table->string('versión')->nullable();
            $table->string('licencia')->nullable();

            $table->string('factura')->nullable();

            $table->unsignedBigInteger('computer_id')->nullable();
            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('software');
    }
}
