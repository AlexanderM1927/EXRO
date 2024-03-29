<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\ValuesVariable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\MessageSend;
use Illuminate\Support\Facades\Mail;
use Log;

class ReportController extends Controller
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


    public function createReport(Request $request)
    {
        $report = new Report;
        $report->idingeniero = Auth::user()->id;
        $report->idproyecto = $request->input('idproyecto');
        $report->fecha = $request->input('fecha');
        $report->observacion = $request->input('observacion');

        $report->save();

        $variables = $request->input('variables');

        $hasVariableOutRange = false;
        $varsOutRange = array();
        foreach($variables as $variable) {
            if (!empty($variable['value'])) {
                $value = $variable['value'];
                $idvariableproyecto = $variable['id'];

                $valuesVariable = new ValuesVariable;
                $valuesVariable->idreport= $report->id;
                $valuesVariable->idvariablesprojects= $idvariableproyecto;
                $valuesVariable->value= $value;
                $valuesVariable->save();

                $varProject = DB::table('variablesprojects')
                ->where('id', $idvariableproyecto)
                ->first();

                if ($value > $varProject->max || $value < $varProject->min) {
                    $var = DB::table('vars')
                    ->where('id', $varProject->idvariable)
                    ->first();

                    array_push($varsOutRange, $var);
                    $hasVariableOutRange = true;
                }

            }
        }

        if ($hasVariableOutRange) {
            $projects = DB::table('engineers_projects')
            ->select('users.name as name', 'projects.name as project_name', 'users.email as email')
            ->join('projects', 'engineers_projects.idproyecto', '=', 'projects.id')
            ->join('users', 'engineers_projects.idingeniero', '=', 'users.id')
            ->where('engineers_projects.idproyecto', '=', $report->idproyecto)
            ->where(function ($query) {
                $query->where('users.rank', '=', 2) //ing
                ->orWhere('users.rank', '=', 4) //sup
                ->orWhere('users.rank', '=', 6); //gerente
            })
            ->get();
            foreach ($projects as $key => $project) {
                $title = "Nuevo reporte | Control Programas Químicos";
                $body = "Hola, ".$project->name."<br>";
                $body .= "<br>";
                $body .= "<br>";
                $body .= "Un usuario ha actualizado los datos de las variables fuera de rango del tratamiento <b>". $project->project_name ."</b>.";
                $body .= "<br>";
                $body .= "<b>Las variables fuera de rango son:</b>";
                $body .= "<br>";
                $body .= "<ul>";
                foreach ($varsOutRange as $key => $value) {
                    $body .= "<li>$value->name</li>";
                }
                $body .= "</ul>";
                $body .= "<br>";
                $body .= "<br>";
                $body .= "<a href='".env('FRONT_URL')."report/".$report->id."'>Ver reporte</a>";
                // Mail::to($project->email)->send(new MessageSend($title,$body,$project->email));
            }
        }
        return response()->json(['report' => $report, 'message' => 'CREATED'], 201);
    }

    public function getReports (Request $request) {
        try {
            $user = Auth::user();
            if ($user->rank == 3) {
                $reports = DB::table('reports')
                ->join('projects', 'projects.id', '=', 'reports.idproyecto')
                ->select('reports.id', 'projects.name', 'reports.fecha')
                ->get();
            } elseif ($user->rank == 2) {
                $reports = DB::table('reports')
                ->join('engineers_projects', 'engineers_projects.idproyecto', '=', 'reports.idproyecto')
                ->join('projects', 'projects.id', '=', 'reports.idproyecto')
                ->where('engineers_projects.idingeniero', '=', $user->id)
                ->select('reports.id', 'projects.name', 'reports.fecha')
                ->get();
            } else {
                $reports = DB::table('reports')
                ->join('projects', 'projects.id', '=', 'reports.idproyecto')
                ->where('projects.idcliente', '=', $user->id)
                ->select('reports.id', 'projects.name', 'reports.fecha')
                ->get();
            }
            return response()->json(['reports' => $reports], 200);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function getReportById ($id) {
        try {
            $reports = DB::table('reports')
            ->join('projects', 'projects.id', '=', 'reports.idproyecto')
            ->join('users', 'users.id', '=', 'projects.idcliente')
            ->where('reports.id', '=', $id)
            ->select('reports.id', 'projects.name', 'users.name as cliente_name', 'reports.fecha', 'reports.observacion')
            ->get()
            ->first();

            $variables = DB::table('values_variables')
            ->join('variablesprojects', 'variablesprojects.id', '=', 'values_variables.idvariablesprojects')
            ->join('vars', 'vars.id', '=', 'variablesprojects.idvariable')
            ->where('values_variables.idreport', '=', $id)
            ->get();

            $report = array(
                'name' => $reports->name,
                'id' => $reports->id,
                'cliente_name' => $reports->cliente_name,
                'fecha' => $reports->fecha,
                'observacion' => $reports->observacion,
                'variables' => $variables
            );

            return response()->json(['report' => $report], 200);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function editReport (Request $request) {
        $observacion = $request->input('observacion');
        $idreport = $request->input('id');
        DB::table('reports')->where('id', '=', $idreport)->update([
            'observacion' => $observacion
        ]);
        $variables = $request->input('variables');
        foreach($variables as $variable) {
            DB::table('values_variables')->where('idreport', '=', $variable['idreport'])->where('idvariablesprojects', '=', $variable['idvariablesprojects'])
            ->update([
                'value' => $variable['value']
            ]);
        }

    }

    public function deleteReport ($id) {
        $report = DB::table('reports')->where('id', '=', $id)->delete();
        $valuevariable= DB::table('values_variables')->where('idreport', '=', $id)->delete();

    }
}
