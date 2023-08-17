<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_hora')->nullable();
            $table->bigInteger('id_mi_empresa')->unsigned()->nullable();
            $table->bigInteger('id_empresa')->unsigned()->nullable();
            $table->bigInteger('id_producto_servicio')->unsigned()->nullable();
            $table->text('descripcion')->nullable();
            $table->text('notas')->nullable();
            $table->string('precio')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();

            $table->foreign('id_mi_empresa')->references('id')->on('users');
            $table->foreign('id_empresa')->references('id')->on('users');
            $table->foreign('id_producto_servicio')->references('id')->on('detalle_productos_empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
