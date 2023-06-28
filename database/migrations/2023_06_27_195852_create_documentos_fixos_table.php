<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosFixosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos_fixos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_arquivo');
            $table->string('tipo');
            $table->string('nome_usuario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_fixos');
    }
}
