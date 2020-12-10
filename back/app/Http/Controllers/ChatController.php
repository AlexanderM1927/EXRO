<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSend;

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
        $user = Auth::user();
        if ($user->rank > 2) {
            $chats = DB::table('chats')
            ->join('users', 'users.id', '=', 'chats.idusuario')
            ->select('users.name as user', 'chats.id', 'chats.message', 'chats.type')
            ->orderByDesc('id')->get();
            return response()->json(['chats' => $chats]);
        }
    }

    public function getChatById ($id) {
        $chat = DB::table('chats')
        ->where('id', '=', $id)
        ->get()
        ->first();
        return response()->json(['chat' => $chat]);
    }

    public function deleteChatById ($id) {
        $user = Auth::user();
        if ($user->rank > 2) {
            $chat = DB::table('chats')->where('id', '=', $id)->delete();
            return response()->json(['chat' => $chat]);
        }
    }

    public function answerChat (Request $request) {
        $user = Auth::user();
        if ($user->rank > 2) {
            $id = $request->input('id');
            $answer = $request->input('answer');
            $user = Auth::user();
            $chat = DB::table('chats')
            ->join('users', 'users.id', '=', 'chats.idusuario')
            ->select('users.email as email', 'chats.id', 'chats.message', 'chats.type')
            ->where('chats.id', '=', $id)
            ->orderByDesc('id')->get()->first();
            $title = 'Respuesta a su '.$chat->type;
            $body = $answer;
            $body .= "<br>";
            $body .= "<br>";
            $body .= "Att:";
            $body .= $user->name;
            Mail::to($chat->email)->send(new MessageSend($title,$body,$chat->email));
            return response()->json(['chat' => $chat, 'message' => 'CREATED'], 201);
        }
    }


}