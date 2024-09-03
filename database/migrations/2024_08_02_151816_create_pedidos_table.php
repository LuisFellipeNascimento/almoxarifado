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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo_pedido');
            $table-> integer('quantidade');
            $table->unsignedBigInteger('id_produtos')->nullable();
            $table->foreign('id_produtos')->references('id')->on('produtos')->onDelete('cascade');
            $table->unsignedBigInteger('id_unidades')->nullable();
            $table->foreign('id_unidades')->references('id')->on('unidades')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
