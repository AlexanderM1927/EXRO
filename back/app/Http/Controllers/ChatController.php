<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
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
    

    public function newChat(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'message' => 'required|string',
            'type' => 'required|string'
        ]);

        try {

            $chat = new Chat;
            $chat->message = $request->input('message');
            $chat->type = $request->input('type');
            $chat->idusuario = $request->input('idusuario');

            $chat->save();

            //return successful response
            return response()->json(['chat' => $chat, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
        }
    }

    public function getChats () {
        $chats = DB::table('chats')
        ->join('users', 'users.id', '=', 'chats.idusuario')
        ->select('users.name as user', 'chats.id', 'chats.message', 'chats.type')
        ->orderByDesc('id')->get();
        return response()->json(['chats' => $chats]);
    }

    public function getChatById ($id) {
        $chat = DB::table('chats')
        ->where('id', '=', $id)
        ->get()
        ->first();
        return response()->json(['chat' => $chat]);
    }

    public function deleteChatById ($id) {
        $chat = DB::table('chats')->where('id', '=', $id)->delete();
        return response()->json(['chat' => $chat]);
    }


}