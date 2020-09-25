<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\variablesprojects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VariablesProjectsController extends Controller
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
    

    public function newVariablesprojects(Request $request)
    {
        try {
            $variablesprojects = new VariablesProjects;
            $variablesprojects->idproyecto = $request->input('idproyecto');
            $variablesprojects->idvariable = $request->input('idvariable');
            $variablesprojects->max = $request->input('max');
            $variablesprojects->min = $request->input('min');

            $variablesprojects->save();

            //return successful response
            return response()->json(['variablesprojects' => $variablesprojects, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function deleteVariableProjectById ($id) {
        $variablesprojects = DB::table('variablesprojects')->where('id', '=', $id)->delete();
        return response()->json(['variablesprojects' => $variablesprojects]);
    }

    public function getVariablesByProject ($id) {
        $variablesprojects = DB::table('variablesprojects')
        ->join('vars', 'vars.id', '=', 'variablesprojects.idvariable')
        ->where('variablesprojects.idproyecto','=',$id)
        ->select('vars.name','variablesprojects.id','variablesprojects.idvariable','variablesprojects.idproyecto','variablesprojects.max','variablesprojects.min')
        ->get();
        return response()->json(['variablesprojects' => $variablesprojects]);
    }

}