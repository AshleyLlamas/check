<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('qr')->nullable();
            $table->bigInteger('número_de_empleado')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('curp')->unique()->nullable();
            $table->date('fecha_de_nacimiento')->nullable();
            $table->date('fecha_de_ingreso')->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('estatus')->nullable()->default('Activo');
            $table->string('puesto')->nullable();
            $table->string('tipo_de_puesto')->nullable();
            $table->decimal('salario_legal', 10, 2)->nullable();
            $table->decimal('salario_complemento', 10, 2)->nullable();

            $table->enum('tipo', ['Empleado', 'Prospecto', 'Reclutado', 'Por contratar'])->nullable();

            $table->string('número_de_inscripción_al_imss')->nullable();

            $table->string('rfc')->nullable();
            $table->string('número_del_infonavit')->nullable();

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('cost_center_id')->nullable();
            $table->foreign('cost_center_id')->references('id')->on('cost_centers')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('document_id')->nullable();
            $table->foreign('document_id')->references('id')->on('user_documents')->onDelete('cascade')->onUpdate('cascade');

            $table->string('slug')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
