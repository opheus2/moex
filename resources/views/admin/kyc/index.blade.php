@extends('admin.layouts.master')
@section('page.name', __('KYC'))
@section('page.body')
@php
    $sn = 1;
@endphp
<admin-users-page inline-template>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('KYC')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        {{-- {{ Breadcrumbs::render('admin.users') }} --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached content-right">
            <div class="content-body">
                <div class="card border-top-primary">
                    <div class="card-head ">
                        <div class="card-header">
                            <h4 class="card-title">Know Your Customer (KYC)</h4>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="trades-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="all"> Username </th>
                                        <th class="all"> DOB </th>
                                        <th class="all"> Address </th>
                                        <th class="none"> Verification Type</th>
                                        <th class="none"> Verification Status</th>
                                        <th class="all"> Front View </th>
                                        <th class="all"> Back View </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kycs as $kyc)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td> {{ ucfirst($kyc->username )}} </td>
                                                <td> {{ $kyc->dob }} </td>
                                                <td> {{ $kyc->address }} </td>
                                                <td> {{ ucfirst($kyc->identity_type) }} </td>
                                                <td> {{ $kyc->verify }} </td>
                                                <td><button data-toggle="modal" data-target="#front-{{ $kyc->id }}" class="btn btn-primary">View</button></td>
                                                <td><button data-toggle="modal" data-target="#back-{{ $kyc->id }}" class="btn btn-primary">View</button> </td>
                                            </tr>
                                        @endforeach                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</admin-users-page>

@foreach($kycs as $kyc)
    <div id="front-{{ $kyc->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img src="/kyc/{{ $kyc->front_view}}" width="100%" height="400px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="back-{{ $kyc->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <img src="/kyc/{{ $kyc->back_view}}" width="100%" height="400px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach