
@php
    $sn = 1;
@endphp

<div class="card border-top-primary">
    <div class="card-head ">
        <div class="card-header">
            <h4 class="card-title">Login History</h4>
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
                                <th class="all"> Location </th>
                                <th class="all"> Internet Provider </th>
                                <th class="all"> User Agent </th>

                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <tr>
                                <th class="all">#</th>
                                <th class="all"> Ip Address </th>
                                <th class="all"> Logged At </th>
                                <th class="all"> Location </th>
                                <th class="all"> Internet Provider </th>
                                <th class="all"> User Agent </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
        </div>
    </div>
</div>
        

@push('data')

<script type="text/javascript">

    
</script>
@endpush



@push('scripts')
    <script type="text/javascript">
        // function reloadUsersTable() {
        //     App._reloadDataTable('#users-list')
        // }
    </script>
@endpush
