<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjusteProdutosFiliais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('filiais', function(Blueprint $table){
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();
        });

        Schema::table('produtos', function(Blueprint $table){
            $table->dropColumn('estoque_minimo');
            $table->dropColumn('estoque_maximo');
            $table->dropColumn('preco_venda');
        });

        Schema::create('produtos_filiais', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            $table->float('preco_venda', 8,2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
            $table->timestamps();


            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos_filiais', function(Blueprint $table){
            $table->dropForeign('produtos_filiais_filial_id_foreign');
            $table->dropForeign('produtos_filiais_produto_id_foreign');
        });

        Schema::dropIfExists('produtos_filiais');

        Schema::table('produtos', function(Blueprint $table){
            $table->float('preco_venda', 8,2)->default(0,01);
            $table->integer('estoque_minimo')->default(1);
            $table->integer('estoque_maximo')->default(1);
        });

        Schema::dropIfExists('filiais');
    }
}
