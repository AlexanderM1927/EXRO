<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VariableController extends Controller
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
    

    public function newVar(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string|unique:vars,name'
        ]);

        try {

            $variable = new Variable;
            $variable->name = $request->input('name');

            $variable->save();

            //return successful response
            return response()->json(['variable' => $variable, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function getVars () {
        $vars = DB::table('vars')->orderByDesc('id')->get();
        return response()->json(['vars' => $vars]);
    }

    public function getVarById ($id) {
        $var = DB::table('vars')
        ->where('id', '=', $id)
        ->get()
        ->first();
        return response()->json(['var' => $var]);
    }

    public function modifyVarById ($id, Request $request) {
        $var = DB::table('vars')->where('id', '=', $id)->update([
            'name' => $request->input('name')
        ]);
        return response()->json(['var' => $var]);
    }

    public function deleteVarById ($id) {
        $var = DB::table('vars')->where('id', '=', $id)->delete();
        return response()->json(['var' => $var]);
    }


}