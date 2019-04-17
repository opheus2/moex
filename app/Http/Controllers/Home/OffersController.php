<?php

namespace App\Http\Controllers\Home;

use App\Models\Currency;
use App\Models\Offer;
use App\Models\Trade;
use App\Models\PaymentMethodCategory;
use App\Notifications\Trades\Started;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use GuzzleHttp\Client;
use Illuminate\Validation\Rule;



class OffersController extends Controller
{
    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $token)
    {
        $offers = Offer::has('user')->where('status', true)
            ->where('token', $token)->get();

        $offers = $offers->filter(function ($offer) {return $offer->canShow(Auth::user());});

        if ($offer = $offers->first()) {
            if($offer->currency == 'USD'){
                $rate           = get_price($offer->multiplier(), $offer->coin, 'NGN', false);
                $rate_formatted = get_price($offer->multiplier(), $offer->coin, 'NGN');
                $currencyRate   = $this->getRate($offer->currency, 'NGN');
                $min_cur_amount = get_price($offer->min_amount, $offer->coin, 'NGN', false);
                $max_cur_amount = get_price($offer->max_amount_with_fee, $offer->coin, 'NGN', false);
            }else{
                $rate           = get_price($offer->multiplier(), $offer->coin, $offer->currency, false);
                $rate_formatted = get_price($offer->multiplier(), $offer->coin, $offer->currency);
                $currencyRate   = $this->getRate($offer->currency, 'USD');
                $min_cur_amount = get_price($offer->min_amount, $offer->coin, $offer->currency, false);
                $max_cur_amount = get_price($offer->max_amount_with_fee, $offer->coin, $offer->currency, false);
            }

            $usd_rate           = $this->getRate($offer->currency, 'USD');
            $usd_rate_formatted = get_price($offer->multiplier(), $offer->coin, 'USD');
            $min_usd_amount     = get_price($offer->min_amount, $offer->coin, 'USD', false);
            $max_usd_amount     = get_price($offer->max_amount_with_fee, $offer->coin, 'USD', false);

            // $min_amount = money($offer->min_amount, $offer->currency, true);
            // $max_amount = money($offer->max_amount, $offer->currency, true);

            $min_amount = $offer->min_amount . $offer->coin;
            $max_amount = $offer->max_amount_with_fee . $offer->coin;



            return view('home.offers.index')
                ->with(compact('min_amount', 'max_amount', 'min_usd_amount', 'max_usd_amount', 'min_cur_amount', 'max_cur_amount'))
                ->with(compact('offer', 'rate', 'rate_formatted', 'usd_rate', 'usd_rate_formatted', 'currencyRate'));
        } else {
            return abort(404);
        }
    }

    public function edit(Request $request, $token)
    {
        $offer = Offer::where('token', $token)->first();
        $payment_methods = $this->getPaymentMethods();
        $min_btc_amount     = get_convert(config('settings.min_offer_amount'), 'BTC',  config('settings.default_currency'));
        $min_ltc_amount     = get_convert(config('settings.min_offer_amount'), 'LTC',  config('settings.default_currency'));
        $min_dash_amount    = get_convert(config('settings.min_offer_amount'), 'DASH',  config('settings.default_currency'));


        $max_btc_amount     = get_convert(config('settings.max_offer_amount'), 'BTC',  config('settings.default_currency'));
        $max_ltc_amount     = get_convert(config('settings.max_offer_amount'), 'LTC',  config('settings.default_currency'));
        $max_dash_amount    = get_convert(config('settings.max_offer_amount'), 'DASH',  config('settings.default_currency'));
        if ($offer) {
            return view('home.offers.edit')->with(compact('offer', 'payment_methods', 'min_btc_amount', 'max_btc_amount', 'min_ltc_amount', 'max_ltc_amount', 'min_dash_amount', 'max_dash_amount'));
        }

        return redirect()->back();
    }
    
    public function getPaymentMethods()
    {
        $categories = PaymentMethodCategory::all();

        $payment_methods = array();

        foreach ($categories as $category) {
            $payment_methods[$category->name] = $category->payment_methods()
                ->get()->pluck('name', 'name');
        }

        return $payment_methods;
    }

    public function update(Request $request, $token)
    {
        $offer = Offer::where('token', $token)->first();

        if ($offer) {
            if($currency = $request->currency){
                $min_offer_amount    = get_convert(config('settings.min_offer_amount'), $request->coin,  config('settings.default_currency'));

                $min_amount_rule = "required|numeric|min:{$min_offer_amount}";

                $max_offer_amount    = Auth::user()->wallet($request->coin)->totalAvailable();
                
                $max_amount_rule = "required|numeric|max:{$max_offer_amount}|gte:min_amount";
            }else{
                $min_amount_rule = 'required|numeric|min:0';
                $max_amount_rule = 'required|numeric|min:0|gte:min_amount';
            }

            $payment_methods = collect($this->getPaymentMethods());
            $coins = collect(get_coins());
            $currencies = collect(get_iso_currencies());

            $this->validate($request, [
                'min_amount'        => $min_amount_rule,
                'max_amount'        => $max_amount_rule,

                'payment_method'    => ['required', Rule::in($payment_methods->flatten())],
                'currency'          => ['required', Rule::in($currencies->keys()->toArray())],
                'coin'              => ['required', Rule::in($coins->keys()->toArray())],

                'tags'              => 'required|array|max:3',

                'label'             => 'required|string|max:25',
                'terms'             => 'required|string',
                'trade_instruction' => 'required|string',

                'deadline'          => 'required|numeric|min:0',
                'profit_margin'     => 'required|numeric',
            ]);

            $offerUpdate = $request->all() ;
            $offerUpdate['profit_margin'] = $request->profit_margin + get_fee_percentage($request->coin);
            $offerUpdate['max_amount_with_fee'] = get_max_with_fee_percentage($request->max_amount, $request->coin);

            $offer->update($offerUpdate);
            return redirect()->route('home.offers.index', ['token' => $token]);
        }

        return redirect()->back();
    }

    public function getRate($from_currency, $to_currency){
        if($from_currency == 'USD') {
            $rate = Currency::where('name', 'NGN');
        }else{
            $rate = Currency::where('name', $from_currency);
        }


        $val  = ($rate->first() == null) ? '' : $rate->first()->rate;

        return $val;
    }
    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function startTrade(Request $request, $token)
    {
        $offers = Offer::has('user')->where('status', true)
            ->where('token', $token)->get();

        $offers = $offers->filter(function ($offer) {
            if (!$offer->canShow(Auth::user(), true)) return false;

            if (!$offer->canTradeWith(Auth::user())) return false;

            return true;
        });

        if ($offer = $offers->first()) {

            $this->validate($request, [
                'amount' => [
                    'required', 'numeric',
                    'min:' . $offer->min_amount,
                    'max:' . $offer->max_amount,
                    function ($attribute, $value, $fail) use ($offer, $request) {
                        if ($offer->type == 'buy') {
                            $balance = Auth::user()->getCoinAvailable($offer->coin);

                            $available = get_price(
                                $balance, $offer->coin, $offer->currency, false
                            );

                            $fee = calc_fee($value, $offer->coin);

                            if (($value + $fee) > $available) {
                                $fail(__('Your current wallet balance is not enough.'));
                            }
                        } else {
                            // Verify if user has an address to receive the coin
                            if (!Auth::user()->getAddressModel($offer->coin)->count()) {
                                $fail(__('You do not have a :coin address yet.', [
                                    'coin' => get_coin($offer->coin)
                                ]));
                            }
                        }
                    },
                ]
            ]);

            $trade = new Trade();

            if($offer->currency == 'NGN'){
                $oddrate = get_price(
                    $offer->multiplier(), $offer->coin, 'USD', false
                );
            }else{
                $oddrate = get_price(
                    $offer->multiplier(), $offer->coin, 'NGN', false
                );
            }

            $rate = get_price(
                $offer->multiplier(), $offer->coin, $offer->currency, false
            );


            $trade->type = ($offer->type == 'sell') ? 'buy' : 'sell';
//            $percent = get_percentage($request->amount, get_fee_percentage($request->coin));
//            $amount = $request->amount - $percent;

            try {

                $trade->fill([
                    'coin'          => $offer->coin,
                    'partner_id'    => $offer->user->id,
                    'offer_id'      => $offer->id,
                    'currency'      => $offer->currency,
                    'fee'           => get_fee_percentage($offer->coin),
                    'offer_terms'   => $offer->terms,
                    'instruction'   => $offer->trade_instruction,
                    'label'         => $offer->label,
                    'payment_method'=> $offer->payment_method,
                    'deadline'      => $offer->deadline,
                    'amount'        => $request->offer_cur,
                    'rate'          => $rate,
                    'odd_rate'      => $oddrate,
                    'amount_btc'    => $request->amount,
                ]);

                $update_max_account         = $offer->max_amount - ($request->amount + (float) config()->get("settings.{$offer->coin}.locked_balance"));
                $offer->max_amount          = $update_max_account;
                $offer->max_amount_with_fee = $offer->max_amount_with_fee - ($request->amount + (float) config()->get("settings.{$offer->coin}.locked_balance"));

                if (!$trade->token) $trade->setToken();

                $trade = Auth::user()->trades()->save($trade);
                $offer->save();

                $trade->partner->notify(new Started($trade));

                return redirect()->route('home.trades.index', [
                    'token' => $trade->token
                ]);
            } catch (\Exception $e) {
                return error_response($request, $e->getMessage());
            }
        } else {
            return abort(404);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $offers = Auth::user()->offers()->get();

            return DataTables::of($offers)
                ->addColumn('action', function ($data) {
                    return view('home.offers.partials.datatable.action')
                        ->with(compact('data'));
                })
                ->editColumn('coin', function ($data) {
                    return get_coin($data->coin);
                })
                ->editColumn('status', function ($data) {
                    if ($data->status) {
                        return "<span class='btn btn-icon round disabled white btn-sm btn-success'><i class='ft-power'></i></span>";
                    } else {
                        return "<span class='btn btn-icon round disabled white btn-sm btn-danger'><i class='ft-power'></i></span>";
                    }
                })
                ->editColumn('profit_margin', function ($data) {
                    return $data->profit_margin . '%';
                })
                ->addColumn('amount_range', function ($data) {
                    $min = money($data->min_amount, $data->currency, true);
                    $max = money($data->max_amount, $data->currency, true);

                    return "<b>{$min}</b>" . ' - ' . "<b>{$max}</b>";
                })
                ->editColumn('type', function ($data) {
                    return strtoupper($data->type);
                })
                ->rawColumns(['action', 'status', 'payment_method', 'amount_range'])
                ->make(true);
        } else {
            return abort(404);
        }
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function toggle(Request $request, $token)
    {
        if ($request->ajax()) {
            if ($offer = Auth::user()->offers()->where('token', $token)->first()) {
                $offer->status = !$offer->status;

                $offer->save();

                return response(__("Your offer has been updated!"));
            } else {
                $message = __('The offer could not be found!');

                return response($message, 404);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Delete user's offer
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request, $token)
    {
        if ($request->ajax()) {
            $offers = Auth::user()->offers()->where('token', $token);

            if ($offer = $offers->first()) {
                try {
                    $offer->delete();

                    return response(__("Offer has been removed!"));

                } catch (\Exception $e) {
                    return response($e->getMessage(), 404);
                }
            } else {
                $message = __('The offer could not be found!');

                return response($message, 404);
            }
        } else {
            return abort(404);
        }
    }

}
