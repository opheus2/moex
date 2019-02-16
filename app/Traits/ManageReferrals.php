<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2/15/2019
 * Time: 2:49 PM
 */

namespace App\Traits;

//const TRADE_CURRENCY = "USD";
const MINIMUM_TRADE_AMOUNT = 1300;

use App\Models\Referral;
use App\Models\User;

trait ManageReferrals
{
    /**
     * @param $user_id
     * @param $referrer_id
     * @return void
     */
    public function newReferral($user_id, $referrer_id)
    {
        $referral = Referral::create([
            'user_id'       => $user_id,
            'referrer_id'   => $referrer_id
        ]);
    }

    /**
     * Validate Referral
     *
     * @param $user_id
     * @return void
     */
    public function validateReferral($user_id)
    {
        $user = User::find($user_id);
        $amount = $user->trades()->sum('amount');

        /*
         * Check if user has traded up to the specified minimum trade amount
         */
        if ($amount < MINIMUM_TRADE_AMOUNT) {
            return;
        }

        $referral = Referral::where('user_id', $user_id)->first();
        if (is_null($referral)) {
            return;
        }

        $referral->is_verified = true;
        $referral->save();
    }
}
