@push('css')
   <style>

   </style>
@endpush
<div class="card border-top-primary">
    <div class="card-head ">
        <div class="card-header">
            <h4 class="card-title">{{__('Verify Your Identity')}}</h4><br/>
            @if (!empty($user->identityDetails))
                @if ( $user->identityDetails->verified == 1)
                    <h4 class="card-title">{{__('NB: Kyc Already Verified')}}</h4>
                @endif
            @endif

        </div>
    </div>
 
    <div class="card-content">
        <div class="card-body">
            <form action="settings/addKyc" method="post" enctype="multipart/form-data">
                @csrf               
                <input type="text" value="{{ $user->id}}" hidden name="user_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('dob', __('Date of Birth')) !!}</h4>
                            
                            {!! Form::date('dob', (!empty($user->identityDetails->dob)) ? $user->identityDetails->dob : '' , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('address', __('Address')) !!}</h4>
                            
                            {!! Form::text('address', (!empty($user->identityDetails->address)) ? $user->identityDetails->address : '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('city', __('City')) !!}</h4>
                            
                            {!! Form::text('city', (!empty($user->identityDetails->city)) ? $user->identityDetails->city : '' , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('state', __('State')) !!}</h4>
                            
                            {!! Form::text('state', (!empty($user->identityDetails->state)) ? $user->identityDetails->state : '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('country', __('Country')) !!}</h4>
                            
                            {!! Form::text('country', (!empty($user->identityDetails->country)) ? $user->identityDetails->country : '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('bvn', __('BVN')) !!}</h4>

                            {!! Form::text('bvn', (!empty($user->identityDetails->bvn)) ? $user->identityDetails->bvn : '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4>{!! Form::label('means', __('Means of Verification')) !!}</h4>

                            {{Form::select('verification_type', get_verification_type(), (!empty($user->identityDetails->identity_type)) ? $user->identityDetails->identity_type : '' , ['is' => 'select2', 'html-class' => 'form-control', 'placeholder' => __('Select means of verification'), 'required' => 'required'])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('front', __('Front View')) !!}</h4><br/>
                            <div class="box">
                                <input type="file" name="front_view" required  class="inputfile inputfile-6" />
                                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>{!! Form::label('front', __('Back View')) !!}</h4><br/>

                            <div class="box">
                                <input type="file" name="back_view" required  class="inputfile inputfile-6"  />
                                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card border-top-primary">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($user->identityDetails && $user->identityDetails->front_view !== null)
                        <img src="/kyc/{{ $user->identityDetails->front_view}}" width="100%" height="400px">
                    @endif
                </div>
                <div class="col-md-6">
                    @if($user->identityDetails && $user->identityDetails->back_view !== null)
                        <img src="/kyc/{{ $user->identityDetails->back_view}}" width="100%" height="400px">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div id="cropper-custom" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="cropper-content">
            <div class="modal-header bg-primary white">
                <span>{{__('Crop and Upload Photo')}}</span>
            </div>
            <div class="modal-body image-container" style="text-align:center;"></div>
            <div class="modal-footer">
                <button class="btn btn-primary crop-upload" type="submit">
                    {{__('Upload')}}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type='text/javascript'>
</script>
@endpush