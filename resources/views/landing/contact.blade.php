@extends('layouts.landing')

@section('content')
<div class="container-fluid banner">
    <div class="row center">
        <h6 class="policy">Contact Us</h6>
        <h6 class="read">Do you have questions or suggestions you want to send to MOEX Team?
Please kindly fill the form below.</h6>
    </div>
</div>
<div class="container other" style="margin-top: 83px; margin-bottom: 83px;">
    <div class="col-md-7 contct">
        <form>
            <div class="row">
                <div class="col-md-12">
                    <h6 class="con">Contact Us</h6>
                </div>
                <div class="col-md-6">
                    <input type="text" required placeholder="Name*" class="form-control con-form">
                </div>
                <div class="col-md-6">
                    <input type="text" required class="form-control con-form" placeholder="Email*">
                </div>
                <div class="col-md-12">
                    <select class="form-control con-sel" value="Message type">
                        <option>Message type</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <textarea class="con-text form-control"> Message</textarea>
                </div>
                <a class="text-color btn btn-purple btn-lg" style="margin-top: 20px; margin-left: 20px;" href="#">Send</a>  

            </div>
        </form>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12 ico-bg">
                <img src="{{ asset('images/location.svg')}}" class="myimage ico"> 
                <h6 class="ico-text">Location</h6>
                <h6 class="ico-text-2">XXXXXXX XXXXXXXXXX XXXXXXX XXXXXXXXX</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ico-bg">
                <img src="{{ asset('images/email.svg')}}" class="myimage ico"> 
                <h6 class="ico-text">Email</h6>
                <h6 class="ico-text-2">XXXXXXX XXXXXXXXXX XXXXXXX XXXXXXXXX</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ico-bg">
                <img src="{{ asset('images/phone.svg')}}" class="myimage ico"> 
                <h6 class="ico-text">Phone</h6>
                <h6 class="ico-text-2">XXXXXXX XXXXXXXXXX XXXXXXX XXXXXXXXX</h6>
            </div>
        </div>
    </div>
</div>
<div class="">
        <img src="{{ asset('images/map.svg')}}" style="width:100%">
    </div>
    <div class="container-fluid bg">
        <div class="">
            <p class="bg-text">Start Trading</p>
            <p class="bg-text-2"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis luctus sodales. </p>
            <div align="center">
                <a class="text-color btn btn-default btn-lg button-sign" style="color:#6C63FF !important" href="#">Sign Up</a>  
            </div>
        </div>
    </div>
    
@endsection