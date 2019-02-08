<template>
    <div>
        <div class="jumbotron">
            <div class="landing-buy text-color">
                <div class="w-93">
                    <span>Buy and Sell Bitcoins Easily</span>
                    <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis arcu et odio volutpat, ornare dignissim ante interdum. </h6>
                    <a style="" class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="about">
                <div class="left mt-5">
                    <h4 class="title">About MyOwn Exchange</h4>
                    <h6 class="subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor imperdiet tincidunt. Nullam nec nulla tortor. Maecenas eros est, tempus sed placerat non, laoreet vitae diam. Aenean eu pretium risus. Pellentesque vel lorem tempus, aliquet justo eleifend, commodo nunc. Aliquam sed libero malesuada, venenatis augue in, ornare lectus.</h6>
                </div>
                <div class="right">
                    <img src="/images/bit.png">
                </div>
            </div>
        </div>
        <div class="" style="margin-bottom:5%;">
            <h4 class="trade" style="margin-top:5%;margin-bottom:0%; text-align:center">Trade Offers</h4>
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-between w-93 sm-block" style="margin-top:0%;margin-bottom:0%;">
                    <div class="pl-0 d-flex child">
                        <h6 class="buy-cash lg-hide " style="margin-bottom:0px; margin-right:15px; margin-top:15px;" >Buy Bitcoins with </h6>
                        <div class="button-group">
                            <select2 v-model="selectedPaymentMethod" :options="paymentMethods.map(method => {return {id: method.id, text: method.name} })"/>
                        </div>
                        <div class="button-group sm-hide">
                            <button class="btn btn-white">In Nigeria</button>
                        </div>
                    </div>
                    <div class="d-flex child">
                        <div class="button-group">
                            <button @click="tableType = 'sell'" class="btn" :class="tableType === 'sell' ? 'btn-purple' : 'btn-white'">Sell Bitcoin</button>
                        </div>
                        <div class="button-group">
                            <button @click="tableType = 'buy'" class="btn" :class="tableType === 'buy' ? 'btn-purple' : 'btn-white'">Buy Bitcoin</button>
                        </div>
                        <div class="button-group lg-hide" style="float:right">
                            <button class="btn btn-white">In Nigeria</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table-view :tableType="tableType" :paymentMethod="selectedPaymentMethod" :paymentMethods="paymentMethods"></table-view>
        <div class="d-flex justify-content-center security" style="width: 100%">
            <div class="row w-93">
                <h6 class="notch">Top Notch Security</h6>
                <div class="col-md-12 px-0">
                    <div class="col-md-3 text-center pl-0">
                        <img class="myimage" src="/images/ssl.png">
                        <h4 class="ssl-text-head">SSL</h4>
                        <h6 class="ssl-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor imperdiet tincidunt.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="transactions myimage" src="/images/transaction.png">
                        <h4 class="ssl-text-head">Transactions</h4>
                        <h6 class="ssl-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor imperdiet tincidunt.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="myimage" src="/images/bitcoin.png">
                        <h4 class="ssl-text-head">Save</h4>
                        <h6 class="ssl-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor imperdiet tincidunt.</h6>
                    </div>
                    <div class="col-md-3 pr-0">
                        <img  class="transactions myimage" src="/images/time.png">
                        <h4 class="ssl-text-head">Quick Response</h4>
                        <h6 class="ssl-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor imperdiet tincidunt.</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 67px;">
            <div class="row w-93">
                <div class="col-md-6" style="padding-left:0px!important;">
                    <img src="/images/convo.png" class="responsive">
                </div>
                <div class="col-md-6" >
                    <div style="float:right; margin-top:10%;">
                    <span class="refer">
                        <h3 >Refer Friends</h3><br>
                        <span class="refer-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor imperdiet tincidunt. Nullam nec nulla tortor. Maecenas eros est, tempus sed placerat non, laoreet vitae diam. Aenean eu pretium risus. Pellentesque vel lorem tempus, aliquet justo eleifend, commodo nunc. Aliquam sed libero malesuada, venenatis augue in, ornare lectus
                        </span>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="count d-flex justify-content-around">
                <div class="row w-93">
                    <div class="col-md-4 text">
                        <h4>$900M+</h4>
                        <h6>Digital Currency Exchanged</h6>
                    </div>
                    <div class="col-md-4 text">
                        <h4>50+</h4>
                        <h6>Countries Supported</h6>
                    </div>
                    <div class="col-md-4 text">
                        <h4>3.1M+</h4>
                        <h6>Customers Served</h6>
                    </div>
                </div>
            </div>
            <!-- <div class="count d-flex justify-content-around">
              <div class="row" style="padding-top: 11%;">
                <div class="col-md-12 text">
                  <h4>$900M+</h4>
                  <h6>Digital Currency Exchanged</h6>
                </div>
              </div>
            </div>
            <div class="count d-flex justify-content-around">
              <div class="row" style="padding-top: 11%;">
                <div class="col-md-12 text">
                  <h4>50+</h4>
                  <h6>Countries Supported</h6>
                </div>
              </div>
            </div>
            <div class="count d-flex justify-content-around">
              <div class="row" style="padding-top: 11%;">
                <div class="col-md-12 text">
                  <h4>3.1M+</h4>
                  <h6>Customers Served</h6>
                </div>
              </div>
            </div> -->
        </div>
        <div class="container-fluid">
            <div class=" col-md-12">
                <h6 class="notch">Partners</h6>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row w-93">
                <div class="col-xs-12 col-md-3 d-flex justify-content-center">
                    <img src="/images/disney.svg" style="margin-top:10%">
                </div>
                <div class="col-xs-12 col-md-3 d-flex justify-content-center">
                    <img src="/images/crit.svg" style="margin-top:10%">
                </div>
                <div class="col-xs12  col-md-3 d-flex justify-content-center">
                    <img src="/images/init.svg" style="margin-top:10%">
                </div>
                <div class="col-xs-12 col-md-3 d-flex justify-content-center">
                    <img src="/images/wil.svg" style="margin-top:10%">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center  join">
            <div class="row w-93">
                <div class="col-xs-12 col-md-8">
                    <p class="us">Join Us</p><br>
                    <span class="text">Like what you see and want to be a part of this amazing community of bitcoin traders? Then sign up today.</span>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="button-group">
                        <button class="btn btn-purple signup">SIGN UP</button>
                        <button class="btn btn-white login">LOGIN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .navbar {
        position: absolute!important;
        width: 100%;
        overflow-x: hidden;
    }
</style>
<script>
    import Select2 from 'v-select2-component';
    import TableView from './TableView';
    // import ClientTable

    export default ({
        name: "Landing",
        data () {
            return {
                selectedPaymentMethod: "all",
                paymentMethods: [],
                tableType: 'sell'
            }
        },
        created () {
            window.axios.get('/api/offers/payment-methods')
                .then(res => {
                    res.data.forEach (method => {
                        this.paymentMethods.push(...method);
                    });
                    this.paymentMethods.push({id: 'all', name: 'All Payment Methods'});
                })
                .catch(err => {
                    console.error(err.response.data);
                })
            ;
        },
        components: {
            TableView,
            Select2
        },
        mounted () {
            // $('#paymentMethods').select2()
        }
    })
</script>
