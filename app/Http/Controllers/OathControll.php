<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OathControll extends Controller
{
    public function index(){
        phpinfo() ;exit;

        return view('oath.index');
    }

    public function test(){
        echo 'test';


    }
}
