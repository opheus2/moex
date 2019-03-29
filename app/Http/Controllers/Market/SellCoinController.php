<?php

namespace App\Http\Controllers\Market;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class SellCoinController extends Controller
{
    /**
     * Show sell offers
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('market.sell_coin.index', [
            'coins' => get_coins(),
        ]);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $offers = Cache::remember("offers.buy", 0, function () {
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
            $offers = $offers->filter(function ($offer) {
                return $offer->tradeShow($offer->user_id, true);
            });

            if ($filter = $request->currency) {
                $offers = $offers->where('currency', $filter);
            }

            if ($filter = $request->amount) {
                $offers = $offers->where('min_amount', '<=', $filter)->where('max_amount', '>=', $filter);
            }

            if ($filter = $request->coin) {
                $offers = $offers->where('coin', $filter);
            }

            if ($filter = $request->payment_method) {
                $offers = $offers->where('payment_method', $filter);
            }

            $offers = $offers->filter(function ($offer) {
                return $offer->canShow(Auth::user(), true);
            });

            return DataTables::of($offers)
                ->addColumn('buyer', function ($data) {
                    return view('market.sell_coin.partials.datatable.buyer')
                        ->with(compact('data'));
                })
                ->editColumn('coin', function ($data) {
                    return get_coin($data->coin);
                })
                ->editColumn('payment_method', function ($data) {
                    return view('market.sell_coin.partials.datatable.payment_method')
                        ->with(compact('data'));
                })
                ->addColumn('amount_range', function ($data) {
                    $min = $data->min_amount . $data->coin;
                    $max = $data->max_amount . $data->coin;

                    return "<b>{$min}</b>" . ' - ' . "<b>{$max}</b>";
                })
                ->addColumn('worth', function ($data) {
                    return (100 - $data->profit_margin) . '%';
                })
                ->addColumn('coin_rate', function ($data) {
                    return get_price(
                        $data->multiplier(), $data->coin, $data->currency
                    );
                })
                ->addColumn('coin_rate_ngn', function ($data) {
                    return get_price(
                        $data->multiplier(), $data->coin, 'NGN'
                    );
                })
                ->addColumn('action', function ($data) {
                    return view('market.sell_coin.partials.datatable.action')
                        ->with(compact('data'));
                })
                ->rawColumns(['coin_rate', 'action', 'amount_range', 'payment_method', 'buyer'])
                ->removeColumn('user_id', 'trusted_offer')
                ->make(true);


        } else {
            return abort(404);
        }
    }
}
