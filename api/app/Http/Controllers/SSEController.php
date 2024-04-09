<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Mision;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SSEController extends Controller
{
    public function streamClanes()
    {
        $response = new StreamedResponse(function () {
            while (true) {
                $ultimoClan = Clan::latest()->first();
                $sseMessage = "data: " . json_encode($ultimoClan) . "\n\n";

                echo $sseMessage;
                ob_flush();
                flush();
                usleep(200000);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }
}
