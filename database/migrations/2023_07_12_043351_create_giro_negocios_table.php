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
        Schema::create('giro_negocios', function (Blueprint $table) {
            $table->id();
            $table->string('giro_negocio')->nullable();
            $table->bigInteger('id_categoria_giro')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_categoria_giro')->references('id')->on('categoria_giros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giro_negocios');
    }
};
