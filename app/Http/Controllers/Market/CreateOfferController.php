<?php

namespace App\Http\Controllers\Market;

use App\Models\Offer;
use App\Models\PaymentMethodCategory;
use Dirape\Token\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class CreateOfferController extends Controller
{
    public function buyIndex()
    {
        $min_btc_amount     = get_convert(config('settings.min_offer_amount'), 'BTC',  config('settings.default_currency'));
        $min_ltc_amount     = get_convert(config('settings.min_offer_amount'), 'LTC',  config('settings.default_currency'));
        $min_dash_amount    = get_convert(config('settings.min_offer_amount'), 'DASH',  config('settings.default_currency'));


        $max_btc_amount     = get_convert(config('settings.max_offer_amount'), 'BTC',  config('settings.default_currency'));
        $max_ltc_amount     = get_convert(config('settings.max_offer_amount'), 'LTC',  config('settings.default_currency'));
        $max_dash_amount    = get_convert(config('settings.max_offer_amount'), 'DASH',  config('settings.default_currency'));

         return view('market.create_offer.buy', [
            'payment_methods' => $this->getPaymentMethods()
            ], compact('min_btc_amount', 'max_btc_amount', 'min_ltc_amount', 'max_ltc_amount', 'min_dash_amount', 'max_dash_amount'));

    }

    public function sellIndex()
    {
        $min_btc_amount     = get_convert(config('settings.min_offer_amount'), 'BTC',  config('settings.default_currency'));
        $min_ltc_amount     = get_convert(config('settings.min_offer_amount'), 'LTC',  config('settings.default_currency'));
        $min_dash_amount    = get_convert(config('settings.min_offer_amount'), 'DASH',  config('settings.default_currency'));


        $max_btc_amount     = get_convert(config('settings.max_offer_amount'), 'BTC',  config('settings.default_currency'));
        $max_ltc_amount     = get_convert(config('settings.max_offer_amount'), 'LTC',  config('settings.default_currency'));
        $max_dash_amount    = get_convert(config('settings.max_offer_amount'), 'DASH',  config('settings.default_currency'));

            return view('market.create_offer.sell', [
            'payment_methods' => $this->getPaymentMethods()
            ], compact('min_btc_amount', 'max_btc_amount', 'min_ltc_amount', 'max_ltc_amount', 'min_dash_amount', 'max_dash_amount'));
    }

    /**
     * Store offer
     *
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $type)
    {
        if($currency = $request->currency){
            // $min_offer_amount = currency_convert(
            //     (float) config('settings.min_offer_amount'), 'USD', $currency
            // );
            $min_offer_amount    = get_convert(config('settings.min_offer_amount'), $request->coin,  config('settings.default_currency'));


            $min_amount_rule = "required|numeric|min:{$min_offer_amount}";

            // $max_offer_amount = currency_convert(
            //     (float) config('settings.max_offer_amount'), 'USD', $currency
            // );
            // $max_offer_amount    = get_convert(config('settings.max_offer_amount'), $request->coin,  config('settings.default_currency'));
            $max_offer_amount    = Auth::user()->wallet($request->coin)->totalAvailable();
            
            $max_amount_rule = "required|numeric|max:{$max_offer_amount}|gte:min_amount";
        }else{
            $min_amount_rule = 'required|numeric|min:0';
            $max_amount_rule = 'required|numeric|min:0|gte:min_amount';
        }

        $payment_methods = collect($this->getPaymentMethods());
        $coins = collect(get_coins());
        $currencies = collect(get_iso_currencies());

        /** @var TYPE_NAME $type */
        if (in_array($type, ['buy', 'sell'])) {
            $user = Auth::user();

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

            try {
                $offer = new Offer();

                $offer->fill($request->only([
                    'coin', 'payment_method', 'currency', 'label', 'trade_instruction',
                    'tags', 'min_amount', 'max_amount', 'deadline', 'terms',
                ]));

                $offer->fill([
                    'trusted_offer'         => $request->filled('trusted_offer'),
                    'phone_verification'    => $request->filled('phone_verification'),
                    'email_verification'    => $request->filled('email_verification'),
                    'kyc_verification'      => $request->filled('kyc_verification'),
                    'type'                  => $type,
                    'user_trade_in'         => strtoupper($request->coin),
                    'profit_margin'         => $request->profit_margin + get_fee_percentage($request->coin),
                    'max_amount_with_fee'   => get_max_with_fee_percentage($request->max_amount, $request->coin),
                ]);

                if (!$offer->token) {
                    $offer->setToken();
                }
            } catch (\Exception $e) {
                return error_response($request, $e->getMessage());
            }

            $user->offers()->save($offer);

            toastr()->success(__('Your offer has been created!'));

            return redirect()->route('home.index');

        } else {
            return abort(404);
        }
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
}
