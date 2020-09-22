<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function newProyect(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        try {
            $proyect = new Proyect;
            $proyect->name = $request->input('name');
            $proyect->descripcion = $request->input('descripcion');
            $proyect->idCliente = auth()->id();

            $proyect->save();

            //return successful response
            return response()->json(['proyect' => $proyect, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function getProyects () {
        $proyects = DB::table('proyects')->get();
        return response()->json(['proyects' => $proyects]);
    }

    public function getProyectsById ($id) {
        $proyect = DB::table('proyects')
        ->where('id', '=', $id)
        ->get()
        ->first();
        return response()->json(['proyects' => $proyect]);
    }

    public function modifyProyectById ($id, Request $request) {
        $proyect = DB::table('proyects')->where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'descripcion' => $request->input('descripcion')
        ]);
        return response()->json(['proyect' => $proyect]);
    }

    public function deleteProyectById ($id) {
        $proyect = DB::table('proyects')->where('id', '=', $id)->delete();
        return response()->json(['proyects' => $proyect]);
    }


}