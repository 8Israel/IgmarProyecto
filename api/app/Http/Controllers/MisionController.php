<?php

namespace App\Http\Controllers;

use App\Models\Mision;
use Illuminate\Http\Request;

use App\Models;
use Validator;

class MisionController extends Controller
{
    public function index($id = null)
    {
        $misiones = Mision::all();
        return response()->json($misiones);
    }
    public function showMisionesComplete($id = null){
        if(!$id){
            return response()->json(Mision::all());
        }
    }
    public function showMisionesInComplete($id = null){

    }
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(), [
            ""=> "required",
        ]);
        $mision = Mision::create($request->all());
        return response()->json(['message'=>'Mision creada correctamente', 'data' => $mision], 201);
    }
    
    public function show($id)
    {
        
        $mision = Mision::findOrFail($id);
        return response()->json($mision);
    }

    public function update(Request $request, $id)
    {
        $mision = Mision::findOrFail($id);
        $mision->update($request->all());
        return response()->json($mision, 200);
    }

    public function destroy($id)
    {
        $mision = Mision::findOrFail($id);
        $mision->delete();
        return response()->json(null, 204);
    }
}