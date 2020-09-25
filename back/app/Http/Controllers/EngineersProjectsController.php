<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EngineersProjects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EngineersProjectsController extends Controller
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
    

    public function newEngineerProject(Request $request)
    {
        try {
            $engineerProject = new EngineersProjects;
            $engineerProject->idingeniero = $request->input('idingeniero');
            $engineerProject->idproyecto = $request->input('idproyecto');

            $engineerProject->save();

            //return successful response
            return response()->json(['engineerProject' => $engineerProject, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }


    public function deleteEngineerProjectById ($id) {
        $engineerProject = DB::table('engineers_projects')->where('id', '=', $id)->delete();
        return response()->json(['engineerProject' => $engineerProject]);
    }

    public function getEngineersByProject ($id) {
        $engineerProject = DB::table('engineers_projects')
        ->join('users', 'users.id', '=', 'engineers_projects.idingeniero')
        ->where('engineers_projects.idproyecto','=',$id)
        ->select('users.name','engineers_projects.id','engineers_projects.idingeniero','engineers_projects.idproyecto')
        ->get();
        return response()->json(['engineerProject' => $engineerProject]);
    }

}