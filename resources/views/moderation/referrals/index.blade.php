@extends('layouts.master')
@section('page.name', __('Referrals'))
@section('page.body')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('Referrals')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        {{ Breadcrumbs::render('moderator_referral') }}
                    </div>
                </div>
            </div>
        </div>
        @include('partials._referrals_details')
    </div>
@endsection