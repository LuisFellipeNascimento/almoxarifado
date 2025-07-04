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
        Schema::create('gerencia_cis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero_ci');
            $table->longText('descricao');
            $table->date('recebimento_ci');
            $table->date('atendimento_ci')->nullable();
            $table->date('data_resposta')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('id_unidades')->nullable();
            $table->foreign('id_unidades')->references('id')->on('unidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gerencia_cis');
    }
};
