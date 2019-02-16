<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = ['user_id', 'referrer_id', 'is_verified', 'has_been_paid'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
