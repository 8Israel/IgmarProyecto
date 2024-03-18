<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;


class LogsController extends Controller
{
    public function index()
    {
        $logs = Logs::orderBy("created_at", "desc")->get();
        // Recuperar los datos del usuario correspondientes a cada log
        $logs->each(function ($log) {
            $user = User::find($log->user_id);
            $log->user = $user; // Agregar los datos del usuario al log
        });
        return response()->json($logs, 200);
    }
}
