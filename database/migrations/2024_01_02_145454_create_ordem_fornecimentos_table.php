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
        Schema::create('ordem_fornecimentos', function (Blueprint $table) {
            $table->id();                       
            $table->string('numero_ordem');
            $table->date('emissao');
            $table->string('empenho');
            $table->string('item');
            $table->double('valor_unitario');
            $table->double('valor_total');
            $table->integer('quant_total');
            $table->unsignedBigInteger('id_fornecedor');
            $table->unsignedBigInteger('id_processo');            
            $table->timestamps();
        });
        Schema::table('ordem_fornecimentos', function (Blueprint $table) { 

            $table->foreign('id_fornecedor')->references('id')->on('fornecedores')->onDelete('cascade');
            $table->foreign('id_processo')->references('id')->on('processo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_fornecimentos');
    }
};
