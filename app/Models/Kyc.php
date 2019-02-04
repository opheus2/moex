<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Kyc extends Model
{

    protected $table    = "kyc";
    protected $fillable = [
        'identity_type', 'front_view', 'back_view', 'dob', 'address', 'user_id'
    ];
    protected $appends = ['username'];



    /**
     * Get user instance who owns this identity card
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUsernameAttribute()
    {
    	return optional(User::find($this->user_id))->name;
    }


}
