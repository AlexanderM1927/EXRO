<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Intervention\Image\Facades\Image as Image;

class ImageController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function getImg ($id) {
        $storagePath = storage_path('images/'.$id);

        return Image::make($storagePath)->response();
    }

}