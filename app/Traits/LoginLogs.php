<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\LoginLog;

/* 
 * A Trait for managing user Logs
 * 
*/
trait LoginLogs
{
    public function getLogData (int $user_id, Request $request) 
    {
        $data = [
            'user_id'       => $user_id,
            'ip_address'    => $request->ip(),
            'useragent'     => $request->userAgent(),
            'logged_at'     => now()->toDateTimeString(),
            'referrer'      => $request->server->get('HTTP_REFERER')
        ];

        return $this->createLogs($user_id, $data);

    }

    public function updateFirstTime(int $log_id, int $user_id)
    {
        $log = $this->getUserLogs($user_id);
        
        if(!$log){
            $lastLog = LoginLog::where('id', $log_id)->first();
            $log->is_first_time = 0;
            $log->save();
        }
    }

    private function createOrUpdateLogs (int $user_id, array $data)
    {
        return $this->createLogs($user_id, $data);
    }

    private function createLogs ($user_id, array $data)
    {
        $log = LoginLog::create($data);
        return $this->updateFirstTime($log->id, $user_id);
    }


    private function getUserLogs(int $user_id)
    {
        return LoginLog::where('user_id', $user_id)->first();
    }
}
