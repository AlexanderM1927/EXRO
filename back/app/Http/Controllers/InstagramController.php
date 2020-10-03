<?php

namespace App\Http\Controllers;

use Log;

class InstagramController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function curl_instagram( $api_url ){
        $ans = file_get_contents($api_url);
        return json_decode($ans);
    }

    public function getPosts() {
        $access_token = 'IGQVJVSnRuVjRfRGdNaDlyMHJLbXkzYXFOMEV0YVdhMlZAXcWZAWT1VvY0wxSG9HX1YxSHZABLVVpdl9nQTJYelI3UmtzQnoycm9WZAC16cGE3a09uNkF6WXRYNng3bGszd0VUcFFYa3doc0ZAtLXBlMHljdwZDZD';
        $user_search = $this->curl_instagram('https://graph.instagram.com/me/media?fields=id,caption,media_url&access_token='. $access_token);
        return response()->json(['ans' => $user_search]);
    }

    //
}
