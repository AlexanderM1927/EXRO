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
        ->select('reports.fecha as fecha', 'vars.name as var_name', 'values_variables.value', 'variablesprojects.max as var_max', 'variablesprojects.min as var_min')
        ->join('values_variables', 'reports.id', '=', 'values_variables.idreport')
        ->join('variablesprojects', 'values_variables.idvariablesprojects', '=', 'variablesprojects.id')
        ->join('vars', 'variablesprojects.idvariable', '=', 'vars.id')
        ->where('variablesprojects.idproyecto', '=', $request->input('idproyecto')) //falta filtro de fechas
        ->get();

        $statistics = array();
        foreach ($reports as $report) {
            if (empty($statistics[$report->var_name])) $statistics[$report->var_name] = array();
            $newArray = array(
                'value' => $report->value,
                'fecha' => $report->fecha,
                'max' => $report->var_max,
                'min' => $report->var_min
            );
            array_push($statistics[$report->var_name], $newArray);
        }
        log::debug( $statistics);
        return response()->json(['statics' => $statistics], 200); 
    }
}