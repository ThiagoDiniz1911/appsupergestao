<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProdutosFornecedoresId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('produtos', function(Blueprint $table){

        $fornecedor_id1 = DB::table('fornecedores')->insertGetId([
            'nome' => 'Fornecedor Padrão',
            'site' => 'fornecedorpadrao.com.br',
            'uf' => 'SP',
            'email' => 'fornecedorpadrao@gmail.com'
        ]);
        //
       
            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id1)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
}
