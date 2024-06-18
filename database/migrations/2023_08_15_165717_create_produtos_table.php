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
            $table->string('lote');
            $table->double('valor', 200);
            $table->string('descricao');
            $table->string('categoria');
            $table->integer('quantidade');
            $table->unsignedBigInteger('fornecedor_id');
            
            $table->timestamps();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
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
