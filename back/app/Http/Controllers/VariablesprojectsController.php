<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\variablesprojects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VariablesprojectsController extends Controller
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
            $variablesprojects = new Variablesprojects;
            $variablesprojects->idProject = $request->input('idProject');
            $variablesprojects->idVariable = $request->input('idVariable');
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

    public function getProjects () {
        $projects = DB::table('projects')->get();
        return response()->json(['projects' => $projects]);
    }

    public function getVariablesByProject ($id) {
        
    }

}