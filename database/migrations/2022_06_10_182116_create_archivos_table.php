<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('evento_id')
            ->nullable()
            ->constrained('eventos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('publicacion_id')
            ->nullable()
            ->constrained('publicacions')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->tinyInteger('activo')->default(1);



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
        Schema::dropIfExists('archivos');
    }
};
