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
        if ($user->rank > 2) {
            //validate incoming request 
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'rank' => 'required',
            ]);

            try {

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

    public function getUser () {
        return Auth::user();
    }

    public function getUsers () {
        $user = Auth::user();
        if ($user->rank > 2) {
            $users = DB::table('users')->get();
            return response()->json(['users' => $users]);
        }
    }

    public function getClients () {
        $user = Auth::user();
        if ($user->rank > 2) {
            $clients = DB::table('users')->where('rank','=','1')->get();
            return response()->json(['users' => $clients]);
        }
    }

    public function getEngineers () {
        $user = Auth::user();
        if ($user->rank > 2) {
            $clients = DB::table('users')->where('rank','=','2')->get();
            return response()->json(['users' => $clients]);
        }
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
            $user = DB::table('users')->where('id', '=', $id)->delete();
            return response()->json(['user' => $user]);
        }
    }

    public function getRankByName ($name) {
        $r = 0;
        if ($name == 'Administrador') $r = 3;
        elseif ($name == 'Ingeniero') $r = 2;
        elseif ($name == 'Cliente') $r = 1;
        return $r;
    }

    public function logout () {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


}