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
        Schema::create('investigadors', function (Blueprint $table) {
            $table->id();

            $table->string('nombre',150);
            $table->string('apellido',100);
            $table->string('grado',150);
            $table->string('lineasInves');
            $table->string('correo');   
            $table->string('proyecto_invest')->nullable();   
            $table->string('reconocimientos')->nullable();   
            $table->text('publicaciones');   

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
        Schema::dropIfExists('investigadors');
    }
};
