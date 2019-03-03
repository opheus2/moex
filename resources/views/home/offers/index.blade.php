@extends('layouts.master')
@section('page.name', get_offer_title($offer))
@push('css')
    <style rel="stylesheet">
        .slide-fade-enter {
            opacity: 0;
            transform: translateY(100px);
        }

        .slide-fade-enter-active {
            transition: all .3s ease;
        }

        div.rating-list {
            height: 200px;
            position: relative;
        }
    </style>
@endpush
@section('page.body')
    <home-offers-page inline-template>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">
                        {{get_offer_title($offer)}}
                    </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            {{ Breadcrumbs::render(($offer->type == 'sell') ? 'buy_offer': 'sell_offer', $offer->token) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-detached content-left">
                <div class="content-body">
                    <section class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        {!! Form::open(['url' => route('home.offers.start-trade', ['token' => $offer->token]), 'class' => 'form form-horizontal']) !!}
                                        <div class="form-body">
                                            <div class="row pb-1">
                                                <h4 class="col-md-12">
                                                    @if($offer->type == 'sell')
                                                        {!! __('HOW MUCH DO YOU WANT TO BUY?') !!}
                                                    @else
                                                        {!! __('HOW MUCH DO YOU WANT TO SELL?') !!}
                                                    @endif
                                                </h4>
                                            </div>

                                            @if(Auth::id() == $offer->user->id)
                                                <div class="bs-callout-warning callout-transparent callout-border-left my-1 p-1">
                                                    <p class="card-text">
                                                        {{__('This is one of your offers!')}}
                                                    </p>
                                                </div>
                                            @endif

                                            <div class="form-group row">
                                                <div class="col-lg-4 col-md-12">
                                                    {!! Form::label('coin_value', __('Amount in Coin:')) !!}
                                                    <div class="input-group">
                                                        {!! Form::number('amount', null, ['class' => 'form-control', 'required', 'v-model.number' => 'coinValue',  'min' => $offer->min_amount, 'max' => $offer->max_amount, 'step' =>".00000001"]) !!}
                                                        {{-- {!! Form::number('coin_value', null, ['class' => 'form-control', 'required', 'v-model.number' => 'coinValue', 'min' => $offer->min_amount, 'max' => $offer->max_amount, 'step' =>".00000001"]) !!} --}}

                                                        <div class="input-group-append">
                                                            <span class="input-group-text">{{strtoupper($offer->coin)}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12">
                                                    {!! Form::label('amount', __('Amount in USD:')) !!}
                                                    <div class="input-group">
                                                        {!! Form::number('usd_amount', null, ['class' => 'form-control', 'required','v-model.number' => 'usd_amount', 'min' => $min_usd_amount,  'max' => $max_usd_amount, 'step' =>"0.01", 'readonly']) !!}
                                                        {{-- {!! Form::number('usd_amount', null, ['class' => 'form-control', 'required', 'v-model.number' => 'usd_amount', 'min' => $min_usd_amount,  'max' => $max_usd_amount, 'step' =>"0.01"]) !!} --}}

                                                        <div class="input-group-append">
                                                            <span class="input-group-text">USD</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12">
                                                    @if($offer->currency == 'USD')
                                                        {!! Form::label('amount', __('Amount in NGN:')) !!}
                                                        <div class="input-group">
                                                            {!! Form::number('amount_cur', null, ['class' => 'form-control', 'required', 'v-model.number' => 'amount', 'min' => $min_cur_amount,  'max' => $max_cur_amount, 'step' =>"0.01", 'readonly']) !!}
                                                             {!! Form::number('offer_cur', null, ['class' => 'form-control', 'required', 'hidden', 'v-model.number' => 'usd_amount', 'min' => $min_usd_amount,  'max' => $max_usd_amount, 'readonly', 'step' =>"0.01"]) !!}

                                                            <div class="input-group-append">
                                                                <span class="input-group-text">NGN</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {!! Form::label('amount', __("Amount in :currency:' ['currency' => $offer->currency ]")) !!}
                                                        <div class="input-group">
                                                            {!! Form::number('amount_cur', null, ['class' => 'form-control', 'required', 'v-model.number' => 'amount', 'min' => $min_cur_amount,  'max' => $max_cur_amount, 'readonly']) !!}
                                                            {!! Form::number('offer_cur', null, ['class' => 'form-control', 'required', 'hidden', 'v-model.number' => 'amount', 'min' => $min_cur_amount,  'max' => $max_cur_amount, 'step' =>"0.01"]) !!}

                                                            <div class="input-group-append">
                                                                <span class="input-group-text">{{ $offer->currency }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            @if($offer->type == 'buy')
                                                <h4 class="card-title">
                                                    {{__('You have :amount on your :coin wallet!', ['amount' => Auth::user()->getCoinAvailable($offer->coin), 'coin' => get_coin($offer->coin)])}}
                                                </h4>
                                            @endif

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-lg btn-success" {{!$offer->canTradeWith(Auth::user()) ? 'disabled': '' }}>
                                                    <span class="font-large-1 text-bold-600">
                                                        @if($offer->type == 'sell') {{__('BUY NOW!')}} @else {{__('SELL NOW!')}} @endif
                                                    </span>
                                                    <!-- br/>
                                                    <small class="text-bold-500">
                                                        {{__('SECURE ESCROW + LIVE CHAT')}}
                                                    </small -->
                                                </button>
                                            </div>

                                            <div class="row">
                                                @if(!$offer->verifyEmail(Auth::user()))
                                                    <div class="col-xl media-list">
                                                        <div class="media">
                                                            <span class="media-left">
                                                                <a href="{{route('profile.settings.index', ['user' => Auth::user()->name])}}"
                                                                   class="btn-icon btn btn-outline-danger btn-round">
                                                                    <i class="la la-envelope"></i>
                                                                </a>
                                                            </span>
                                                            <div class="media-body">
                                                                <h5 class="media-heading text-bold-400">
                                                                    {{__('Email Verification Required')}}
                                                                </h5>
                                                                {{__('The user requires that you verify your email before you can continue with the trade.')}}
                                                                {{__('If you have not received a confirmation email, you may resend in your profile settings')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!$offer->verifyPhone(Auth::user()))
                                                    <div class="col-xl media-list">
                                                        <div class="media">
                                                            <span class="media-left">
                                                                <a href="{{route('profile.settings.index', ['user' => Auth::user()->name])}}"
                                                                   class="btn-icon btn btn-outline-danger btn-round">
                                                                    <i class="la la-phone"></i>
                                                                </a>
                                                            </span>
                                                            <div class="media-body">
                                                                <h5 class="media-heading text-bold-400">
                                                                    {{__('Phone Verification Required')}}
                                                                </h5>
                                                                {{__('The user requires that you verify your phone number before you can continue with the trade.')}}
                                                                {{__('If you have not received a confirmation sms, you may resend in your profile settings')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!$offer->verifyKyc(Auth::user()))
                                                    <div class="col-xl media-list">
                                                        <div class="media">
                                                            <span class="media-left">
                                                                <a href="{{route('profile.settings.index', ['user' => Auth::user()->name])}}"
                                                                   class="btn-icon btn btn-outline-danger btn-round">
                                                                    <i class="ft-shield"></i>
                                                                </a>
                                                            </span>
                                                            <div class="media-body">
                                                                <h5 class="media-heading text-bold-400">
                                                                    KYC Verification Required
                                                                </h5>
                                                                {{__('The user requires that your kyc must be verify before you can continue with the trade.')}}
                                                                {{__('If you have not submit your kyc details, go to your profile settings')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="bs-callout-black callout-transparent callout-border-left mt-1 p-1">
                                                        <h4 class="black">{{__('INFORMATION')}}</h4>
                                                        <p class="card-text">
                                                            {!! __('Your amount should be between :min_amount and :max_amount', ['min_amount' => "<b>{$min_amount}</b>", 'max_amount' => "<b>{$max_amount}</b>"] , 'in sellers currency') !!}
                                                            <br/>
                                                            @php $worth = (100 - $offer->profit_margin); @endphp
                                                            {!! __('You will get :worth% worth of your money in return for this trade.', ['worth' => "<b>{$worth}</b>"]) !!}
                                                            <br/>
                                                            {!! __('Rate per :coin is :rate. You can buy any fraction', ['rate' => "<b>{$rate_formatted}</b>",'coin' => get_coin($offer->coin)]) !!}
                                                            <br/>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="bs-callout-warning callout-transparent callout-border-left mt-1 p-1">
                                                        <h4 class="warning">{{__('IMPORTANT')}}</h4>
                                                        <p class="card-text">
                                                            {!! __('The buyer of this trade has a time limit of :deadline minutes to pay for the trade before the trade is cancelled by the system.', ['deadline' => "<b>{$offer->deadline}</b>"]) !!}
                                                            <br/>
                                                            {!! __('Trade will not auto-cancel when buyer has marked trade as paid. After that buyer has to wait for seller to release coin.') !!}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>


                                            <h4 class="form-section">
                                                <i class="ft-info"></i> {{__('Offer Terms By :user', ['user' => $offer->user->name])}}
                                            </h4>

                                            <blockquote class="blockquote">
                                                {!! nl2br(e($offer->terms)) !!}
                                            </blockquote>

                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="sidebar-detached sidebar-right">
                <div class="sidebar">
                    <div class="bug-list-sidebar-content">
                        <div class="card">
                            <div class="text-center">
                                <div class="card-body">
                                    <img src="{{getProfileAvatar($offer->user)}}" alt="{{$offer->user->name}}"
                                         class="rounded-circle height-150">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{route('profile.index', ['user' => $offer->user->name])}}">
                                            {{$offer->user->name}}
                                        </a>
                                    </h4>
                                    <h6 class="card-subtitle text-muted">
                                        <span class="avatar avatar-lg" :class="avatarPresenceObject"><i></i></span>
                                        <span v-text="lastSeenPresence"></span>
                                    </h6>
                                    <h6 class="pt-1 text-muted">
                                        <rating :score="{{$offer->user->averageRating() ?? 0}}" size="md"></rating>
                                    </h6>

                                </div>
                                <div class="text-center">
                                    <a href="{{share_link('facebook', request()->fullUrl(), get_offer_title($offer))}}" class="btn btn-social-icon mr-1 mb-1 btn-facebook" target="_blank">
                                        <span class="la la-facebook"></span>
                                    </a>
                                    <a href="{{share_link('twitter', request()->fullUrl(), get_offer_title($offer))}}" class="btn btn-social-icon mr-1 mb-1 btn-twitter" target="_blank">
                                        <span class="la la-twitter white"></span>
                                    </a>
                                    <a href="{{share_link('linkedin', request()->fullUrl(), get_offer_title($offer))}}" class="btn btn-social-icon mb-1 btn-linkedin" target="_blank">
                                        <span class="la la-linkedin"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('RATINGS')}}</h4>
                            </div>
                            <div class="card-content">
                                <div class="media-list media-bordered">
                                    <div class="rating-list" ref="ratingScrollWrapper" infinite-wrapper>
                                        <transition-group tag="div" name="slide-fade">
                                            <div class="media" v-for="(rating, id) in ratings.data" :key="rating.id">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="media-heading">
                                                            <a :href="'/profile/'+rating.user.name">
                                                                <b>@{{ rating.user.name }}</b>
                                                            </a>
                                                            {{__('wrote:')}}
                                                        </h5>
                                                        @{{rating.comment}}
                                                        <div class="media-notation mt-1 no-wrap">
                                                            @{{ dateDiffForHumans(rating.created_at) }} |
                                                            <rating :score="rating.rating"></rating>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </transition-group>

                                        <infinite-loading @infinite="ratingInfiniteHandler" ref="ratingInfiniteLoading">
                                            <h3 slot="no-more" class="text-center">{{__('No more results available!')}}</h3>
                                        </infinite-loading>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home-offers-page>

@endsection

@push('data')
    <script type="text/javascript">
        window._vueData = {!! json_encode([
                'offer' => $offer,

                'profile' => [
                    'id' => $offer->user->id,
                    'lastSeen' => $offer->user->last_seen,
                    'presence' => $offer->user->presence
                ],

                'rate' => $rate,
                'usd_rate' => $usd_rate,
                'cur_rate' => $currencyRate,
                'currency' => $offer->currency,

            ]) !!}
    </script>
@endpush
