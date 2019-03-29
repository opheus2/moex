<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2/15/2019
 * Time: 2:49 PM
 */

namespace App\Traits;

const MINIMUM_BTC_TRADED = 4;

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

        return $this->userTradeInUSD($user) >= get_price($this->getMinimumBTC(), 'BTC', 'USD');
    }

    /**
     * Get minimum trade amount
     *
     * @return integer
     */
    private function getMinimumBTC()
    {
        return env('MINIMUM_BTC_TRADED', MINIMUM_BTC_TRADED);
    }

    /**
     * Get the amount of BTC a user has transacted
     * 
     * @return float
     */
    private function userTradeInUSD(User $user) {
        // TODO: Calculate the amount of trades for the user
        $btc_amount = 0;
        $dash_amount = 0;
        $ltc_amount = 0;
        foreach ($user->trades as $trade) {
            if (strtoupper($trade->coin) == 'BTC') {
                $btc_amount += $trade->amount;
            } elseif (strtoupper($trade->coin) == 'LTC') {
                $ltc_amount += $trade->amount;
            } else {
                $dash_amount += $trade->amount;
            }
        }
        
        return ($btc_amount > 0 ? get_price($btc_amount, 'BTC', 'USD') : 0) 
                + ($ltc_amount > 0 ? get_price($ltc_amount, 'LTC', 'USD'): 0) 
                 + ($dash_amount > 0 ? get_price($dash_amount, 'DASH', 'USD'): 0);
    }
}
