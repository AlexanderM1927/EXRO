<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        
        try {
            $report = new Report;
            $report->idingeniero = $request->input('idingeniero');
            $report->idproyecto = $request->input('idproyecto');
            $report->fecha = $request->input('fecha');

            $report->save();
            return response()->json(['report' => $report, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    


}