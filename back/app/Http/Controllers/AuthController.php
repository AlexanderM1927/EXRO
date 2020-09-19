<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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
            return $this->respondWithToken($user,$token);
        }
    }


}