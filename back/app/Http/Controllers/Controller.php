<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected function respondWithToken($user,$token)
    {
        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer'
        ], 200);
    }
}
