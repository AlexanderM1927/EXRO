<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppLogController extends Controller
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
    

    public function newAppLog($user_id, $type, $action)
    {
        try {
            $appLog = new AppLog;
            $appLog->user_id = $user_id;
            $appLog->type = $type;
            $appLog->action = $action;

            $appLog->save();

            return true;

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getAppLogs(Request $request, $numItemsPerPage, $page, $search = '')
    {
        return AppLog::select(
            'logs.*',
            'users.name',
            DB::raw("(SELECT COUNT(*) FROM logs) as total")
        )
        ->where(function ($query) use ($search) {
            if ($search != '') {
                $query->where('logs.type', 'LIKE', '%'.$search.'%');
                $query->orWhere('users.name', 'LIKE', '%'.$search.'%');
            }
        })
        ->leftJoin('users', 'logs.user_id', '=', 'users.id')
        ->orderBy('logs.created_at', 'DESC')
        ->offset(($page*$numItemsPerPage))
        ->limit($numItemsPerPage)
        ->get();
    }

}