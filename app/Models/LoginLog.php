<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $fillable = ['user_id', 'ip_address', 'logged_at', 'useragent', 'referrer', 'is_first_time', 'location', 'isp'];
}
