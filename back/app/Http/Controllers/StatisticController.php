<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;

class StatisticController extends Controller
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

    public function getStats (Request $request) {
        
        $reports = DB::table('reports')
        ->select('reports.fecha as fecha', 'reports.observacion as observacion', 'users.name as ingeniero', 'vars.id as var_id', 'vars.name as var_name', 'values_variables.value', 'variablesprojects.max as var_max', 'variablesprojects.min as var_min', 'variablesprojects.razon_outrange as razon_outrange')
        ->join('values_variables', 'reports.id', '=', 'values_variables.idreport')
        ->join('users', 'users.id', '=', 'reports.idingeniero')
        ->join('variablesprojects', 'values_variables.idvariablesprojects', '=', 'variablesprojects.id')
        ->join('vars', 'variablesprojects.idvariable', '=', 'vars.id')
        ->where('variablesprojects.idproyecto', '=', $request->input('idproyecto')) //falta filtro de fechas
        ->whereBetween('reports.fecha', [$request->input('from'), $request->input('to')])
        ->get();

        $statistics = [];
        foreach ($reports as $report) {
            if (empty($statistics[$report->var_id])) $statistics[$report->var_id] = [];
            $newArray = array(
                'var_name' => $report->var_name,
                'value' => $report->value,
                'fecha' => $report->fecha,
                'max' => $report->var_max,
                'min' => $report->var_min,
                'razon_outrange' => $report->razon_outrange,
                'observacion' => $report->observacion,
                'ingeniero' => $report->ingeniero
            );
            array_push($statistics[$report->var_id], $newArray);
        }
        return response()->json(['statics' => $statistics], 200); 
    }

    public function getStatsGrilla (Request $request) {
        
        $reports = DB::table('reports')
        ->select('reports.id as id', 'reports.fecha as fecha', 'vars.id as var_id', 'vars.name as var_name', 'values_variables.value')
        ->join('values_variables', 'reports.id', '=', 'values_variables.idreport')
        ->join('variablesprojects', 'values_variables.idvariablesprojects', '=', 'variablesprojects.id')
        ->join('vars', 'variablesprojects.idvariable', '=', 'vars.id')
        ->where('variablesprojects.idproyecto', '=', $request->input('idproyecto')) //falta filtro de fechas
        ->whereBetween('reports.fecha', [$request->input('from'), $request->input('to')])
        ->get();

        $statistics = array();
        foreach ($reports as $report) {
            if (empty($statistics[$report->id])) $statistics[$report->id] = array();
            $newArray = array(
                'date' => $report->fecha,
                'var_name' => $report->var_name,
                'var_id' => $report->var_id,
                'value' => $report->value
            );
            array_push($statistics[$report->id], $newArray);
        }
        return response()->json(['statics' => $statistics], 200); 
    }


    /*

     array = [
     report1 => [{
         fecha,
         varname,
         value
     }],
     report2 => [{
         fecha,
         varname,
         value
     }]
     ]

     needs

     ________________
     - fecha        -
     ________________


    */
}