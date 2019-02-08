<?php

namespace App\Http\Controllers\Resources;

use App\Models\Offer;
use App\Models\PaymentMethodCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class OffersController extends Controller
{
    /**
     * Get data of buy offers
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function buy(Request $request)
    {
        $offers = Cache::remember("offers.buy", 30, function () {
            return Offer::has('user')
                ->where('type', 'buy')->where('status', true)
                ->with([
                    'user'         => function ($query) {
                        $query->select([
                            'id', 'name', 'presence', 'last_seen', 'currency', 'status', 'timezone',
                            'verified_phone', 'verified', 'schedule_delete', 'schedule_deactivate'
                        ]);
                    },
                    'user.profile' => function ($query) {
                        $query->select([
                            'id', 'user_id', 'picture', 'first_name', 'last_name', 'bio'
                        ]);
                    }
                ])->get();
        });

        if ($filter = $request->currency) {
            $offers = $offers->where('currency', $filter);
        }

        if ($filter = $request->coin) {
            $offers = $offers->where('coin', $filter);
        }

        if ($filter = $request->amount) {
            $offers = $offers->where('min_amount', '<=', $filter)->where('max_amount', '>=', $filter);
        }

        if ($filter = $request->payment_method) {
            $offers = $offers->where('payment_method', $filter);
        }

        $offers = $offers->filter(function ($offer) {
            return $offer->canShow();
        });

        return paginate($offers, 100);
    }

    /**
     * Get data of sell offers
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function sell(Request $request)
    {
        $offers = Cache::remember("offers.sell", 30, function () {
            return Offer::has('user')
                ->where('type', 'sell')->where('status', true)
                ->with([
                    'user'         => function ($query) {
                        $query->select([
                            'id', 'name', 'presence', 'last_seen', 'currency', 'status', 'timezone',
                            'verified_phone', 'verified', 'schedule_delete', 'schedule_deactivate'
                        ]);
                    },
                    'user.profile' => function ($query) {
                        $query->select([
                            'id', 'user_id', 'picture', 'first_name', 'last_name', 'bio'
                        ]);
                    }
                ])->get();
        });

        if ($filter = $request->currency) {
            $offers = $offers->where('currency', $filter);
        }

        if ($filter = $request->coin) {
            $offers = $offers->where('coin', $filter);
        }

        if ($filter = $request->amount) {
            $offers = $offers->where('min_amount', '<=', $filter)->where('max_amount', '>=', $filter);
        }

        if ($filter = $request->payment_method) {
            $offers = $offers->where('payment_method', $filter);
        }

        $offers = $offers->filter(function ($offer) {
            return $offer->canShow();
        });

        return paginate($offers, 100);
    }

    /**
     * Get offer by id
     *
     * @param $id
     * @return Offer|Offer[]
     */
    public function get($id)
    {
        return Offer::has('user')
            ->where('status', true)->where('type', 'buy')
            ->with([
                'user'         => function ($query) {
                    $query->select([
                        'id', 'name', 'presence', 'last_seen', 'currency', 'status', 'timezone',
                        'verified_phone', 'verified', 'schedule_delete', 'schedule_deactivate'
                    ]);
                },
                'user.profile' => function ($query) {
                    $query->select([
                        'id', 'user_id', 'picture', 'first_name', 'last_name', 'bio'
                    ]);
                }
            ])
            ->findOrFail($id);
    }

    /**
     * @return array
     */
    public function getPaymentMethods()
    {

        $categories = PaymentMethodCategory::all();

        $payment_methods = collect([]);

        foreach ($categories as $category) {
            $payment_methods->push($category->payment_methods()->get());
        }

        return $payment_methods;
    }

    public function sellTest()
    {
        $json = '{
    "current_page": 1,
    "data": {
        "1": {
            "id": 4,
            "token": "2w4UWUDMaL",
            "type": "sell",
            "coin": "btc",
            "currency": "USD",
            "user_id": 7,
            "status": 1,
            "min_amount": 50,
            "max_amount": 200,
            "profit_margin": 5,
            "payment_method": "Cash Deposit To Banks",
            "tags": [
                "no verification needed"
            ],
            "trade_instruction": "shown after",
            "terms": "shown before",
            "label": "INSTANT RELEASE",
            "phone_verification": 0,
            "email_verification": 0,
            "trusted_offer": 0,
            "deadline": 5,
            "created_at": "2019-01-26 21:42:52",
            "updated_at": "2019-01-26 21:42:52",
            "user": {
                "id": 7,
                "name": "Opheus",
                "presence": "offline",
                "last_seen": "2019-02-06 18:33:01",
                "currency": "USD",
                "status": "active",
                "timezone": "UTC",
                "verified_phone": 0,
                "verified": false,
                "schedule_delete": 0,
                "schedule_deactivate": 0,
                "identity_details": null,
                "profile": null
            }
        },
        "2": {
            "id": 3,
            "token": "L9VIwopMC9",
            "type": "sell",
            "coin": "btc",
            "currency": "USD",
            "user_id": 7,
            "status": 1,
            "min_amount": 1,
            "max_amount": 300,
            "profit_margin": 5,
            "payment_method": "Bank Transfers",
            "tags": [
                "online payments"
            ],
            "trade_instruction": "shown after",
            "terms": "shown before",
            "label": "INSTANT RELEASE",
            "phone_verification": 0,
            "email_verification": 0,
            "trusted_offer": 0,
            "deadline": 30,
            "created_at": "2019-01-26 21:38:37",
            "updated_at": "2019-01-26 21:38:37",
            "user": {
                "id": 7,
                "name": "Opheus",
                "presence": "offline",
                "last_seen": "2019-02-06 18:33:01",
                "currency": "USD",
                "status": "active",
                "timezone": "UTC",
                "verified_phone": 0,
                "verified": false,
                "schedule_delete": 0,
                "schedule_deactivate": 0,
                "identity_details": null,
                "profile": null
            }
        },
        "3": {
            "id": 7,
            "token": "5VISvULoCH",
            "type": "sell",
            "coin": "btc",
            "currency": "USD",
            "user_id": 6,
            "status": 1,
            "min_amount": 100,
            "max_amount": 200,
            "profit_margin": 5,
            "payment_method": "Microsoft Gift Card",
            "tags": [
                "no receipt needed"
            ],
            "trade_instruction": "None",
            "terms": "University Of Uyo, Mechanical Engineering Department\r\nFaculty Of Engineering",
            "label": "Instant Release",
            "phone_verification": 0,
            "email_verification": 0,
            "trusted_offer": 0,
            "deadline": 6,
            "created_at": "2019-02-04 19:35:47",
            "updated_at": "2019-02-04 19:35:47",
            "user": {
                "id": 6,
                "name": "jaycodes",
                "presence": "away",
                "last_seen": "2019-02-06 21:48:57",
                "currency": "USD",
                "status": "active",
                "timezone": "UTC",
                "verified_phone": 0,
                "verified": false,
                "schedule_delete": 0,
                "schedule_deactivate": 0,
                "identity_details": null,
                "profile": null
            }
        },
        "4": {
            "id": 8,
            "token": "UwyaqFVGgJ",
            "type": "sell",
            "coin": "btc",
            "currency": "USD",
            "user_id": 6,
            "status": 1,
            "min_amount": 60,
            "max_amount": 200,
            "profit_margin": 5,
            "payment_method": "Nike Gift Card",
            "tags": [
                "no receipt needed"
            ],
            "trade_instruction": "None",
            "terms": "28 Edem Urua Street\r\nFaculty Of Engineering",
            "label": "Instant Release",
            "phone_verification": 0,
            "email_verification": 0,
            "trusted_offer": 0,
            "deadline": 10,
            "created_at": "2019-02-04 19:36:37",
            "updated_at": "2019-02-04 19:36:37",
            "user": {
                "id": 6,
                "name": "jaycodes",
                "presence": "away",
                "last_seen": "2019-02-06 21:48:57",
                "currency": "USD",
                "status": "active",
                "timezone": "UTC",
                "verified_phone": 0,
                "verified": false,
                "schedule_delete": 0,
                "schedule_deactivate": 0,
                "identity_details": null,
                "profile": null
            }
        }
    },
    "first_page_url": "http://expresscargo.me/api/offers/sell?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://expresscargo.me/api/offers/sell?page=1",
    "next_page_url": null,
    "path": "http://expresscargo.me/api/offers/sell",
    "per_page": 100,
    "prev_page_url": null,
    "to": 4,
    "total": 4
}';
        $client = new Client(['base_uri' => 'http://expresscargo.me/api/offers/']);
        $response = $client->get('sell');
        return $response->getBody();

//        return $json;
    }

    public function buyTest()
    {
        $json = '{
            "current_page": 1,
            "data": [
                {
                    "id": 5,
                    "token": "0YRZyeYlFk",
                    "type": "buy",
                    "coin": "btc",
                    "currency": "USD",
                    "user_id": 7,
                    "status": 1,
                    "min_amount": 50,
                    "max_amount": 1000,
                    "profit_margin": 5,
                    "payment_method": "Bank Transfers",
                    "tags": [
                        "online payments"
                    ],
                    "trade_instruction": "eeeeeee",
                    "terms": "1824 Millrun Pl\r\nyyyyyy",
                    "label": "INSTANT RELEASE",
                    "phone_verification": 0,
                    "email_verification": 0,
                    "trusted_offer": 0,
                    "deadline": 30,
                    "created_at": "2019-02-04 15:23:06",
                    "updated_at": "2019-02-04 15:23:06",
                    "user": {
                        "id": 7,
                        "name": "Opheus",
                        "presence": "offline",
                        "last_seen": "2019-02-08 16:07:01",
                        "currency": "USD",
                        "status": "active",
                        "timezone": "UTC",
                        "verified_phone": 0,
                        "verified": false,
                        "schedule_delete": 0,
                        "schedule_deactivate": 0,
                        "identity_details": null,
                        "profile": {
                            "id": 1,
                            "user_id": 7,
                            "picture": null,
                            "first_name": null,
                            "last_name": null,
                            "bio": null
                        }
                    }
                },
                {
                    "id": 9,
                    "token": "emwEWxseTw",
                    "type": "buy",
                    "coin": "btc",
                    "currency": "USD",
                    "user_id": 6,
                    "status": 1,
                    "min_amount": 50,
                    "max_amount": 100,
                    "profit_margin": 5,
                    "payment_method": "Cardless Cash",
                    "tags": [
                        "no verification needed"
                    ],
                    "trade_instruction": "jjaksd",
                    "terms": "28 Edem Urua Street\r\nFaculty Of Engineering",
                    "label": "Instant Release",
                    "phone_verification": 0,
                    "email_verification": 0,
                    "trusted_offer": 0,
                    "deadline": 10,
                    "created_at": "2019-02-07 14:58:07",
                    "updated_at": "2019-02-07 14:58:07",
                    "user": {
                        "id": 6,
                        "name": "jaycodes",
                        "presence": "away",
                        "last_seen": "2019-02-08 17:59:39",
                        "currency": "USD",
                        "status": "active",
                        "timezone": "UTC",
                        "verified_phone": 0,
                        "verified": false,
                        "schedule_delete": 0,
                        "schedule_deactivate": 0,
                        "identity_details": null,
                        "profile": null
                    }
                },
                {
                    "id": 10,
                    "token": "EBjC1B82pT",
                    "type": "buy",
                    "coin": "btc",
                    "currency": "USD",
                    "user_id": 6,
                    "status": 1,
                    "min_amount": 51,
                    "max_amount": 100,
                    "profit_margin": 5,
                    "payment_method": "Cash Deposit To Banks",
                    "tags": [
                        "no verification needed"
                    ],
                    "trade_instruction": "jkasddb",
                    "terms": "28 Edem Urua Street\r\nFaculty Of Engineering",
                    "label": "Instant Release",
                    "phone_verification": 0,
                    "email_verification": 0,
                    "trusted_offer": 0,
                    "deadline": 10000,
                    "created_at": "2019-02-07 15:00:56",
                    "updated_at": "2019-02-07 15:00:56",
                    "user": {
                        "id": 6,
                        "name": "jaycodes",
                        "presence": "away",
                        "last_seen": "2019-02-08 17:59:39",
                        "currency": "USD",
                        "status": "active",
                        "timezone": "UTC",
                        "verified_phone": 0,
                        "verified": false,
                        "schedule_delete": 0,
                        "schedule_deactivate": 0,
                        "identity_details": null,
                        "profile": null
                    }
                }
            ],
            "first_page_url": "http://expresscargo.me/api/offers/buy?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://expresscargo.me/api/offers/buy?page=1",
            "next_page_url": null,
            "path": "http://expresscargo.me/api/offers/buy",
            "per_page": 100,
            "prev_page_url": null,
            "to": 3,
            "total": 3
        }';

        $client = new Client(['base_uri' => 'http://expresscargo.me/api/offers/']);
        $response = $client->get('buy');
        return $response->getBody();

//        return $json;
    }
}
