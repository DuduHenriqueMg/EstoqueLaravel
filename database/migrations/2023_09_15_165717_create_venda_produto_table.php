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
        Schema::create('venda_produto', function (Blueprint $table) {
            $table->id();
            $table->string('data');
            $table->double('valor', 200);
            $table->integer('quantidade');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('venda_id');
            
            $table->timestamps();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('venda_id')->references('id')->on('vendas');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_produto');
    }
};
