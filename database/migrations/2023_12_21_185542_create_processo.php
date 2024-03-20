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
        Schema::create('processo', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('descricao');
            $table->double('valor');
            $table->string('item');
            $table->integer('quantidade');
            $table->unsignedBigInteger('id_fornecedor');         
            $table->foreign('id_fornecedor')->references('id')->on('fornecedores')->onDelete('cascade');
        
            $table->timestamps();
        });

    
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processo');
    }
};
