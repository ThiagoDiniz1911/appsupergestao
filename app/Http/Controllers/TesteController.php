<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function metodo(int $p1, int $p2){
        //echo "Olá $p1 e $p2 a soma de vcs é ". ($p1 + $p2);
        //return view ('site.teste', ['p1' => $p1, 'p2' => $p2]);
        //return view ('site.teste', compact('p1', 'p2'));
        return view ('site.teste') -> with ('p1', $p1) -> with ('p2', $p2);
    }
}
