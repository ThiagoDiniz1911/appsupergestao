<?php

use Illuminate\Database\Seeder;
use \App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fornecedor = new Fornecedor();
        $fornecedor->nome = "Thiago 100";
        $fornecedor->site = "www.thiago100.com.br";
        $fornecedor->uf = "SP";
        $fornecedor->email = "thiago100@gmail.com";
        $fornecedor->save();

        Fornecedor::create(['nome' => 'Thiago 200', 'site' => 'thiago200.com.br', 
        'uf' => 'SP', 'email' => 'thiago200@gmail.com']);

        DB::table('fornecedores')->insert([
            'nome' => 'Thiago400',
            'site' => 'thiago400.com.br',
            'uf' => 'SP',
            'email' => 'thiago400@gmail.com'
        ]);
    }
}
