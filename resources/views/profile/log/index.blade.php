@extends('layouts.master')
@section('page.name', __("Login Logs"))
@section('page.body')
@php
    $sn = 1;
@endphp
<div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('KYC')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        {{ Breadcrumbs::render('kyc') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-detached">
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
                                    <table id="kyc-list" class="table table-white-space table-bordered row-grouping display icheck table-middle">
                                        <thead>
                                            <tr>
                                                <th class="all">#</th>
                                                <th class="all"> Ip Address </th>
                                                <th class="all"> Logged At </th>
                                                <th class="all"> User Agent </th>
                                                <th class="all"> Referrer </th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <tr>
                                                <th class="all">#</th>
                                                <th class="all"> Ip Address </th>
                                                <th class="all"> Logged At </th>
                                                <th class="all"> User Agent </th>
                                                <th class="all"> Referrer </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('data')

<script type="text/javascript">

    window._tableData = [
        {
            'selector': '#kyc-list',
            'options': {
                processing: true,
                serverSide: true,
                "ajax": {
                        "async": true,
                        "type": "GET",
                        "url": '{{route('home.logData', ['id' => $log->user_id])}}',
                    },
                columns: [
                    {data: null, defaultContent: ''},
                    {data: 'ip_address'},
                    {data: 'logged_at'},
                    {data: 'useragent'},
                    {data: 'referrer'},
                ]
            }
        }
    ]
</script>
@endpush



@push('scripts')
    <script type="text/javascript">
        // function reloadUsersTable() {
        //     App._reloadDataTable('#users-list')
        // }
    </script>
@endpush
