<?php

namespace App\Http\Controllers\Home;

use App\Models\Offer;
use App\Models\Trade;
use App\Notifications\Trades\Started;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use GuzzleHttp\Client;



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
                $max_cur_amount = get_price($offer->max_amount, $offer->coin, 'NGN', false);
            }else{
                $rate           = get_price($offer->multiplier(), $offer->coin, $offer->currency, false);
                $rate_formatted = get_price($offer->multiplier(), $offer->coin, $offer->currency);
                $currencyRate   = $this->getRate($offer->currency, 'USD');
                $min_cur_amount = get_price($offer->min_amount, $offer->coin, $offer->currency, false);
                $max_cur_amount = get_price($offer->max_amount, $offer->coin, $offer->currency, false);
            }

            $usd_rate           = get_price($offer->multiplier(), $offer->coin, 'USD', false);
            $usd_rate_formatted = get_price($offer->multiplier(), $offer->coin, 'USD');
            $min_usd_amount     = get_price($offer->min_amount, $offer->coin, 'USD', false);
            $max_usd_amount     = get_price($offer->max_amount, $offer->coin, 'USD', false);

            // $min_amount = money($offer->min_amount, $offer->currency, true);
            // $max_amount = money($offer->max_amount, $offer->currency, true);

            $min_amount = $offer->min_amount . $offer->coin;
            $max_amount = $offer->max_amount . $offer->coin;

            

            return view('home.offers.index')
                ->with(compact('min_amount', 'max_amount', 'min_usd_amount', 'max_usd_amount', 'min_cur_amount', 'max_cur_amount'))
                ->with(compact('offer', 'rate', 'rate_formatted', 'usd_rate', 'usd_rate_formatted', 'currencyRate'));
        } else {
            return abort(404);
        }
    }

    public function getRate($from_currency, $to_currency){
        $from_Currency  = urlencode($from_currency);
        $to_Currency    = urlencode($to_currency);
        $query          = $from_Currency.$to_Currency;
        $url            = "http://apilayer.net/api/live?access_key=47edfa1856dc3a1c879fc17f5c4d0ad9&currencies=$to_Currency&source=$from_Currency&format=1";
        // $url            = "https://forex.1forge.com/1.0.3/convert?from=$from_Currency&to=$to_Currency&quantity=1&api_key=J7TOjmVUd0ziobpXLfRk6h1ZNIVTZEow";
        // $url            = "https://forex.1forge.com/1.0.3/convert?from=USD&to=EUR&quantity=1&api_key=J7TOjmVUd0ziobpXLfRk6h1ZNIVTZEow";

        $client         = new Client();
        $response       = $client->get($url);

        $response       = json_decode($client->get($url)->getBody(), true);

        $val            = $response['quotes'][$query];

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

            $rate = get_price(
                $offer->multiplier(), $offer->coin, $offer->currency, false
            );

            $trade->type = ($offer->type == 'sell') ? 'buy' : 'sell';

            try {

                $trade->fill([
                    'coin' => $offer->coin,
                    'partner_id' => $offer->user->id,
                    'offer_id' => $offer->id,
                    'currency' => $offer->coin,
                    'fee' => get_fee_percentage($offer->coin),
                    'offer_terms' => $offer->terms,
                    'instruction' => $offer->trade_instruction,
                    'label' => $offer->label,
                    'payment_method' => $offer->payment_method,
                    'deadline' => $offer->deadline,
                    'amount' => $request->amount,
                    'rate' => $rate
                ]);

                if (!$trade->token) $trade->setToken();

                $trade = Auth::user()->trades()->save($trade);
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
