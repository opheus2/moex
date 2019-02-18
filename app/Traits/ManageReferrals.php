<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2/15/2019
 * Time: 2:49 PM
 */

namespace App\Traits;

const MINIMUM_TRADE_AMOUNT = 10;

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

        $referral = Referral::where('user_id', $user_id)->first();
        if (is_null($referral) || $referral->is_verified) {
            return;
        }

        if ( !$this->isValidated($user) ) {
            return;
        }

        $referral->is_verified = true;
        $referral->save();
    }

    /**
     * Checks if user is validated
     *
     * @param User $user
     * @return bool
     */
    public function isValidated(User $user)
    {
       return $this->isUserVerified($user) && $this->hasCompletedTrades($user);
    }

    /**
     * Checks if user has passed all the verification tests
     *
     * @param User $user
     * @return bool
     */
    private function isUserVerified (User $user)
    {
        return $user->identityDetails && $user->verified_phone && $user->verified;
    }

    /**
     * Checks if user has completed required amount of trades
     *
     * @param User $user
     * @return bool
     */
    private function hasCompletedTrades (User $user)
    {
        return $user->trades->count() >= $this->getMinimumTradeAmount();
    }

    /**
     * Get minimum trade amount
     *
     * @return integer
     */
    private function getMinimumTradeAmount()
    {
        return env('MINIMUM_TRADE_AMOUNT', MINIMUM_TRADE_AMOUNT);
    }
}
