<?php

namespace App\Http\Controllers;

use App\Events\NuevaMision;
use Illuminate\Http\Request;

class testwebsoket extends Controller
{
    public function test(){
        event(new NuevaMision());
    }
}
