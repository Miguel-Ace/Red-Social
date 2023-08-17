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
        Schema::create('detalle_productos_empresas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_empresa')->unsigned()->nullable();
            $table->string('producto_servicio')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('precio')->nullable();
            $table->string('tipo_token')->nullable();
            $table->timestamps();

            $table->foreign('id_empresa')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_productos_empresas');
    }
};
