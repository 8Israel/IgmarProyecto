<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Heroe;
use App\Models\Mision;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SSEController extends Controller
{
    public function streamClanes()
    {
        $response = new StreamedResponse(function () {
                $ultimoClan = Clan::latest()->first();
                if($ultimoClan)
                {
                    $sseMessage = "data: " . json_encode($ultimoClan) . "\n\n";
                    echo $sseMessage;
                }
                else
                {
                    echo "\n\n";
                }               
                ob_flush();
                flush();
        }); 
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');
        return $response;
    }
}
