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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('eslogan')->nullable();
            $table->text('descripcion')->nullable();
            $table->bigInteger('id_giro_negocio')->unsigned()->nullable();
            $table->string('url_logo')->nullable();
            $table->bigInteger('id_pais')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_giro_negocio')->references('id')->on('giro_negocios');
            $table->foreign('id_pais')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
