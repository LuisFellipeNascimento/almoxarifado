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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('nome');
            $table->string('local');
            $table->date('vencimento')->nullable(); 
            $table->integer('estoque_min');
            $table->integer('estoque_ideal'); 
            $table->double('valor_saida'); 
            $table->integer('quant_total');
            $table->string('foto')->nullable();
            $table->string('codigobarras')->nullable();     
            $table->longText('observacao')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
     
        });
        Schema::table('produtos', function (Blueprint $table) { 

            $table->foreign('id_categoria')->references('id')->on('categoria')->onDelete('cascade');
          
        });
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
