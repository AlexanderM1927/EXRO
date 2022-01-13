<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
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
    

    public function newSetting($map, $field, $value)
    {
        try {
            $setting = new Setting;
            $setting->map = $map;
            $setting->field = $field;
            $setting->value = $value;

            $setting->save();

            return true;

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSettings(Request $request)
    {
        return Setting::get();
    }

    public function getSettingByMap(Request $request, $map) {
        return Setting::where('map', '=', $map)
        ->first();
    }

    public function updateSetting($id, Request $request) {
        $var = DB::table('settings')->where('id', '=', $id)->update([
            'field' => $request->input('field'),
            'value' => $request->input('value')
        ]);
        return response()->json(['var' => $var]);
    }

}