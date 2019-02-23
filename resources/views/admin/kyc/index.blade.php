@extends('admin.layouts.master')
@section('page.name', __('KYC'))
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
                                                <th class="all"> Username </th>
                                                <th class="all"> BVN </th>
                                                <th class="all"> DOB </th>
                                                <th class="all"> Address </th>
                                                <th class="all"> Location </th>
                                                <th class="all"> Verification Type</th>
                                                <th class="all"> Verification Status</th>
                                                <th class="all"> Front View </th>
                                                <th class="all"> Back View </th>
                                                <th class="all"> Action </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <tr>
                                                <th class="all">#</th>
                                                <th class="all"> Username </th>
                                                <th class="all"> BVN </th>
                                                <th class="all"> DOB </th>
                                                <th class="all"> Address </th>
                                                <th class="all"> Location </th>
                                                <th class="all"> Verification Type</th>
                                                <th class="all"> Verification Status</th>
                                                <th class="all"> Front View </th>
                                                <th class="all"> Back View </th>
                                                <th class="all"> Action </th>
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
                        "type": "POST",
                        "url": '{{route('admin.kyc.data')}}',
                    },
                columns: [
                    {data: null, defaultContent: ''},
                    {data: 'username'},
                    {data: 'bvn'},
                    {data: 'dob'},
                    {data: 'address', searchable: false, orderable: false},
                    {data: 'location', searchable: false, orderable: false},
                    {data: 'identity_type', searchable: false, orderable: false},
                    {data: 'verify', searchable: false, orderable: false},
                    {data: 'front', searchable: false, orderable: false},
                    {data: 'back', searchable: false, orderable: false},
                    {data: 'actions', searchable: false, orderable: false},
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
