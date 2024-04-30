<?php

use Illuminate\Database\Seeder;
use \App\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /*$contato = new SiteContato();
        $contato->nome = 'Thiago Diniz';
        $contato->telefone = '(11)5555-7777';
        $contato->email = 'thiagodiniz@gmail.com';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Olá mundo';
        $contato->save();*/

        Factory(SiteContato::class, 100)->create();


    }
}
