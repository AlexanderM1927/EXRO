<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\MessageSend;
use Illuminate\Support\Facades\DB;
use Log;
use App\Http\Controllers\AppLogController;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
            
        if (! $token = auth()->setTTL(7200)->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            $user = Auth::user();
            $log = new AppLogController;
            $log->newAppLog($user->id, 'LOGIN', 'Ha iniciado sesión');
            return $this->respondWithToken($user,$token);
        }
    }

    public function generateToken () {
        $token = Str::random(60);

        return hash('sha256', $token);
    }

    public function recoveryPassword(Request $request) {
        try {
            $user = DB::table('users')
            ->where('email', '=', $request->input('email'))
            ->get()
            ->first();
            if ($user) {
                $token = $this->generateToken();
                $title = "Recupera tu clave | Control Programas Químicos";
                $body = "Hola, ".$user->name."<br>";
                $body .= "<br>";
                $body .= "<br>";
                $body .= "Si has solicitado cambiar tu clave, entra al siguiente enlace, de lo contrario ignora este email";
                $body .= "<br>";
                $body .= "<a href='".env('FRONT_URL')."changepassword/".$token."'>Cambiar clave</a>";
                Mail::to($user->email)->send(new MessageSend($title,$body,$user->email));
                $user = DB::table('users')->where('email', '=', $request->input('email'))->update([
                    'token_recovery' => $token
                ]);
                return response()->json(['message' => 'Enviado'], 200);
            } else {
                return response()->json(['message' => 'No se encontro el correo'], 201);
            }
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function updatePassword(Request $request) {
        try {
            $user = DB::table('users')
            ->where('token_recovery', '=', $request->input('token'))
            ->get()
            ->first();
            if ($user) {
                $token = $request->input('token');
                $plainPassword = $request->input('password');
                $password = app('hash')->make($plainPassword);
                $user = DB::table('users')->where('token_recovery', '=', $request->input('token'))->update([
                    'password' => $password,
                    'token_recovery' => ''
                ]);
                return response()->json(['message' => 'Clave actualizada'], 200);
            } else {
                return response()->json(['message' => 'No se encontró el token'], 201);
            }
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

}