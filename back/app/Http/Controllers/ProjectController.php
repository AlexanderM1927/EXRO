<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;

class ProjectController extends Controller
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
    

    public function newProject(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        try {
            $project = new Project;
            $project->name = $request->input('name');
            $project->descripcion = $request->input('descripcion');
            $file = $request->file('photo');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $destination_path = 'images';
            $path = $file->move($destination_path, $imageName);
            $project->urlimg = $path;
            $project->idcliente = $request->input('idcliente');

            $project->save();
            return response()->json(['project' => $project, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function getProjects () {
        $user = Auth::user();
        Log::debug($user);
        $projects = DB::table('projects')->get();
        return response()->json(['projects' => $projects]);
    }

    public function getProjectsById ($id) {
        $project = DB::table('projects')
        ->where('id', '=', $id)
        ->get()
        ->first();
        return response()->json(['project' => $project]);
    }

    public function modifyProjectById ($id, Request $request) {
        $file = $request->file('photo');
        if ($file != null) {
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $destination_path = 'images';
            $path = $file->move($destination_path, $imageName);
            $project = DB::table('projects')->where('id', '=', $id)->update([
                'name' => $request->input('name'),
                'descripcion' => $request->input('descripcion'),
                'urlimg' => $path
            ]);
        } else {
            $project = DB::table('projects')->where('id', '=', $id)->update([
                'name' => $request->input('name'),
                'descripcion' => $request->input('descripcion')
            ]);
        }
        return response()->json(['project' => $project]);
    }

    public function deleteProjectById ($id) {
        $project = DB::table('projects')->where('id', '=', $id)->delete();
        return response()->json(['projects' => $project]);
    }


}