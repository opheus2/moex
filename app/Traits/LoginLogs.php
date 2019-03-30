<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\LoginLog;
use GuzzleHttp\Client;


/* 
 * A Trait for managing user Logs
 * 
*/
trait LoginLogs
{
    public function getLogData (int $user_id, Request $request) 
    {
        $url            = "https://api.ipgeolocation.io/ipgeo?apiKey=b6b481f32a4446b1a0a6a90067e0f10d&ip=".$request->ip();
        // $url            = "https://api.ipgeolocation.io/ipgeo?apiKey=b6b481f32a4446b1a0a6a90067e0f10d&ip=105.112.43.161";

        $client         = new Client();
        $response       = $client->get($url);

        $response       = json_decode($client->get($url)->getBody(), true);

        $country        = $response['country_name'];
        $state          = $response['state_prov'];
        $latlong        = $response['latitude'] . ',' . $response['longitude'];
        $isp            = $response['isp'];
        $data = [
            'user_id'       => $user_id,
            'ip_address'    => $request->ip(),
            'useragent'     => $request->userAgent(),
            'logged_at'     => now()->toDateTimeString(),
            'referrer'      => $request->server->get('HTTP_REFERER'),
            'isp'           => $isp,
            'location'      => $state. ', ' . $country,
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
