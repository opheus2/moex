<div class="card border-top-primary">
    <div class="card-head ">
        <div class="card-header">
            <h4 class="card-title">All Referrals</h4>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> User </th>
                        <th> Referred By </th>
                        <th> Status </th>
                        <th> Payment Status </th>
                        {{-- <th>Action</th>  --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($referrals as $referral)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-capitalize"><a href="{{ route('profile.index', $referral->user->name) }}"> {{ $referral->user->name }} </a></td>
                                <td class="text-capitalize"><a href="{{ route('profile.index', $referral->referrer->name) }}"> {{ $referral->referrer->name}} </a></td>
                                <td class="text-capitalize">
                                    @if ($referral->is_verified)
                                        <button type="button" class="btn btn-success" >Verified</button>  
                                    @else
                                        <button class="btn btn-danger">Unverified</button>
                                    @endif
                                </td>
                                <td class="text-capitalize"> 
                                    @if ($referral->has_been_paid)
                                        <button type="button" class="btn btn-success">Paid</button>
                                    @else
                                        <button type="button" class="btn {{ $referral->is_verified ? 'btn-danger' : 'btn-secondary' }} ">Not Paid</button>
                                    @endif
                                </td>
                                {{-- <td></td> --}}
                            </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>