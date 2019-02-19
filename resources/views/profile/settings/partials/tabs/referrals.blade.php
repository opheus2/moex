<div class="card border-top-primary">
    <div class="card-header">
        <h4 class="card-title">Referral Url</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="alert alert-primary" role="alert">
                <strong>{{route('referral.url', auth()->user()->name)}}</strong>
            </div>
            <p>The above url should be used to refer users to the platform. Referring a user to the platform attracts an earning of 100USD.</p>
            <p><strong>Note: </strong> <em>You can <strong>only</strong> receive your earnings after the referred user has been verified and has made a minimum of 10 trades</em></p>
        </div>
    </div>
</div>
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
                        <th> Status </th>
                        <th> Payment Status </th>
                        <th> Actions</th>
                        {{-- <th>Action</th>  --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($referrals as $referral)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-capitalize"><a href="{{ route('profile.index', $referral->user->name) }}"> {{ $referral->referrer->name}} </a></td>
                                <td class="text-capitalize">
                                    @if ($referral->is_verified)
                                        <button type="button" class="btn btn-success" >Verified</button>  
                                    @else
                                        <button class="btn btn-danger">Unverified</button>
                                    @endif
                                </td>
                                
                                @if ($referral->has_been_paid)
                                    <td class="text-capitalize"> 
                                        <button type="button" class="btn btn-success">Paid</button>
                                    </td>
                                    
                                @else
                                    <td>
                                        <button type="button" class="btn {{ $referral->is_verified ? 'btn-danger' : 'btn-secondary' }} ">Not Paid</button>
                                    </td>
                                @endif
                                @if ($referral->is_verified && !$referral->has_been_paid)
                                    <td>
                                        <button type="button" class="btn btn-light">Request for Payment</button>
                                    </td> 
                                @else 
                                    <td>
                                        <button type="button" class="btn btn-light" disabled>Request for Payment</button>
                                    </td> 
                                @endif
                                
                            </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>