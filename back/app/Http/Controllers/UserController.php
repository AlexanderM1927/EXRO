<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    

    public function register(Request $request)
    {
        $user = Auth::user();
        if ($user->rank === 3) {
            //validate incoming request 
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'rank' => 'required',
            ]);

            try {

                $log = new AppLogController;
                $log->newAppLog($user->id, 'USUARIO', 'Ha creado al usuario '.$request->input('name'));

                $user = new User;
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $plainPassword = $request->input('password');
                $user->password = app('hash')->make($plainPassword);
                $user->rank = $this->getRankByName($request->input('rank'));

                $user->save();

                //return successful response
                return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => $e], 409);
            }
        }
    }

    public function registerChildren(Request $request)
    {
        $myUser = Auth::user();
        if ($myUser->rank === 1) {
            //validate incoming request 
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            try {

                $log = new AppLogController;
                $log->newAppLog($user->id, 'USUARIO', 'Ha creado al usuario '.$request->input('name'));

                $user = new User;
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $plainPassword = $request->input('password');
                $user->password = app('hash')->make($plainPassword);
                $user->rank = 7;
                $user->parent_id = $myUser->id;

                $user->save();

                //return successful response
                return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => $e], 409);
            }
        }
    }

    public function getUser () {
        return Auth::user();
    }

    public function getUsers () {
        $users = DB::table('users')->get();
        return response()->json(['users' => $users]);
    }

    public function getChildrens () {
        $user = Auth::user();
        $users = DB::table('users')->where('parent_id', '=', $user->id)->get();
        return response()->json(['users' => $users]);
    }

    public function getClients () {
        $user = Auth::user();
        $clients = DB::table('users')->where('rank','=',1)->get();
        return response()->json(['users' => $clients]);
    }

    public function getEngineers () {
        $user = Auth::user();
        $engineers = DB::table('users')->where('rank','=',2)->get();
        return response()->json(['users' => $engineers]);
    }

    public function getTechnicals () {
        $user = Auth::user();
        $technicals = DB::table('users')->where('rank','=',5)->get();
        return response()->json(['users' => $technicals]);
    }

    public function getManagers () {
        $user = Auth::user();
        $managers = DB::table('users')->where('rank','=',6)->get();
        return response()->json(['users' => $managers]);
    }

    public function getSupervisors () {
        $user = Auth::user();
        $supervisors = DB::table('users')->where('rank','=',4)->get();
        return response()->json(['users' => $supervisors]);
    }
    
    public function getUserById ($id) {
        $user = DB::table('users')
        ->where('id', '=', $id)
        ->get()
        ->first();
        return response()->json(['user' => $user]);
    }

    public function modifyUserById ($id, Request $request) {
        $user = Auth::user();
        if ($user->rank > 2) {
            $log = new AppLogController;
            $log->newAppLog($user->id, 'USUARIO', 'Ha modificado al usuario '.$id.' - '.$request->input('name'));
            $user = DB::table('users')->where('id', '=', $id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'rank' => $this->getRankByName($request->input('rank'))
            ]);
            return response()->json(['user' => $user]);
        }
    }

    public function deleteUserById ($id) {
        $user = Auth::user();
        if ($user->rank > 2) {
            $log = new AppLogController;
            $log->newAppLog($user->id, 'USUARIO', 'Ha eliminado al usuario '.$id);
            $user = DB::table('users')->where('id', '=', $id)->delete();
            return response()->json(['user' => $user]);
        }
    }

    public function getRankByName ($name) {
        $r = 0;
        if ($name == 'Administrador') $r = 3;
        elseif ($name == 'Ingeniero') $r = 2;
        elseif ($name == 'Cliente') $r = 1;
        elseif ($name == 'Supervisor') $r = 4;
        elseif ($name == 'Tecnico') $r = 5;
        elseif ($name == 'Gerente') $r = 6;
        elseif ($name == 'Cliente hijo') $r = 7;
        return $r;
    }

    public function logout () {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


}