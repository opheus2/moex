<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Log;

/* 
 * A Trait for managing user Logs
 * 
*/
trait ManageLogs
{
    public function curateLog (int $user_id, Request $request) 
    {
        $data = [
            'user_id'       => $user_id,
            'ip_address'    => $request->ip(),
            'useragent'     => $request->userAgent(),
            'logged_at'     => now()->toDateTimeString(),
            'referrer'      => $request->server->get('HTTP_REFERER')
        ];

        return $this->createOrUpdateLog($user_id, $data);

    }

    public function updateFirstTimeLogin(int $user_id)
    {
        $log = $this->getUserLog($user_id);
        
        $log->is_first_time = false;
        $log->save();
    }

    private function createOrUpdateLog (int $user_id, array $data)
    {
        $log = $this->getUserLog($user_id);

        if (is_null($log)) {
            return $this->createLog($data);
        } else {
            $data['is_first_time'] = false;
            return $this->updateLog($data, $log);
        }
    }

    private function createLog (array $data)
    {
        $log = Log::create($data);
        return $log;
    }

    private function updateLog (array $data, Log $userLog) 
    {
        $userLog->update($data);
        return $userLog;
    }

    private function getUserLog(int $user_id)
    {
        return Log::where('user_id', $user_id)->first();
    }
}
