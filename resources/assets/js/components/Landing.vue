<template>
    <div>
        <div class="jumbotron">
            <div class="landing-buy text-color">
                <div class="w-93">
                    <span>Buy and Sell Bitcoins Easily</span>
                    <h6>Exchange your bitcoins for cash in minutes easily. <br>It's safe, reliable and fast!. </h6>
                    <a class="landing-custom btn btn-purple signup" href="/register">Get Started</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="about">
                <div class="left mt-5">
                    <h4 class="title">WHAT TO KNOW</h4>
                    <h6 class="subtitle">MOEX is a peer to peer exchange service provider that allows you to trade your cryptocurrencies such as Bitcoin, Litecoin and other types of cryptocurrency with an escrow fee of just 1% and no seller fee.</h6>
                </div>
                <div class="right">
                    <img src="/images/bit.png">
                </div>
            </div>
        </div>
        <div class="table-container">
            <h5 class="trade" style="text-align:center">Trade Offers</h5>
            <div class="d-flex justify-content-center" style="margin-bottom:12px;">
                <div class="d-flex justify-content-between w-93 d-sm-block" style="margin-top:0%;margin-bottom:0%;">
                    <div class="pl-0 d-flex child">
                        <select2 v-model="selectedPaymentMethod" class="w-sm-100 pl-sm-0" :options="paymentMethods"/>
                        <div class="w-sm-100">
                            <select v-model="selectedCoin" id="selectedCoin" style="margin-left: 5px" class="form-control">
                                <option value="All">All Coins</option>
                                <option value="BTC">BitCoin</option>
                                <option value="LTC">LiteCoin</option>
                                <option value="DSH">DashCoin</option>
                            </select>
                        </div>
                        
                        <!-- <div class="sm-hide">
                            <select class="form-control" disabled>
                                <option>In Nigeria</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="d-flex child mt-sm-2">
                        <div class="w-sm-100 d-flex">
                            <div class="w-sm-100 pl-sm-0 link-holder">
                                <a @click.prevent="tableType = 'sell'" class="mylink" :class="tableType === 'sell' ? 'link-active' : ''">Sell</a>
                            </div>
                            <div class="w-sm-100 link-holder">
                                <a @click.prevent="tableType = 'buy'" class="mylink" :class="tableType === 'buy' ? 'link-active' : ''">Buy</a>
                            </div>
                        </div>
                        <div class="w-sm-100 pr-sm-0">
                            <select class="form-control" disabled>
                                <option>In Nigeria</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <table-view :tableType="tableType" :coin="selectedCoin" :paymentMethod="selectedPaymentMethod" :paymentMethods="children"></table-view>
            </div>
        </div>
        <div class="d-flex justify-content-center security" style="width: 100%">
            <div class="row w-93">
                <h6 class="notch">Features</h6>
                <div class="col-md-12 px-0">
                    <div class="col-md-3 text-center pl-0">
                        <img class="myimage" src="/images/ssl.png">
                        <h4 class="ssl-text-head">Security</h4>
                        <h6 class="ssl-text">256-Bit encryption SSL to always keep yor transcactions safe and secure.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="transactions myimage" src="/images/transaction.png">
                        <h4 class="ssl-text-head">Transactions</h4>
                        <h6 class="ssl-text">Peer to peer transactions with disputing makes sure you never loose your money.</h6>
                    </div>
                    <div class="col-md-3">
                        <img class="myimage" src="/images/bitcoin.png">
                        <h4 class="ssl-text-head">Wallet</h4>
                        <h6 class="ssl-text">Sign up and get a personalised wallet to save your coins. Completely free no deposit/withdrawal fees!.</h6>
                    </div>
                    <div class="col-md-3 pr-0">
                        <img  class="transactions myimage" src="/images/time.png">
                        <h4 class="ssl-text-head">Quick Response</h4>
                        <h6 class="ssl-text">24/7 Customer Service at your fingertips! Hit us up at any time - We are always here for you.</h6>
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
                        <span class="refer-text">You can earn <b>NGN 20,000.00 </b>  worth of any cryptocurrency of your choice for every sucessful referral.
Commission will be credited directly to your account and can be used immediately.
<b>*Terms and Conditions apply.</b>
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
                    <p class="us">Join Us<br>
                    <span class="text">Like what you see and want to be a part of this amazing community of bitcoin traders? Then sign up today.</span></p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="button-group">
                        <a class="btn btn-purple signup groupbuttons" href="/register">SIGN UP</a>
                        <a class="btn btn-white login groupbuttons"  href="/login">SIGN IN </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .mylink {
        font-size: 20px;
        font-weight: bold;
        color: #ededed;
        cursor: pointer;
        padding-bottom: 3px;
    }
    .link-holder {
        width: 150px;
        margin-right: 5px;
    }
    .mylink:hover {
        text-decoration: none;
        color: #ffffff;
    }
    .link-active {
        color: white;
        text-decoration:none;
        border-bottom: solid 2px #ffffff;
    }
    @media (min-width: 760px) {
        .select2 {
            width: 170px !important;
        }
    }
    @media (min-width: 760px) and (max-width: 1000px) {
        .link-holder {
            width:70px;
        }
    }
    .select2-selection__rendered {
        color: #6C63FF;
    }
    .select2-container--default .select2-selection--single {
        border-radius: 5px;
        height: 34px;
        padding-top: 2px;
        border-color:rgba(107, 99, 255, 0.246)
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 3px;
    }
    .table-container {
        background-color: #6C63FF;
        padding-top: 10px;
    }
    .table-container > h5 {
        color: #ffffff;
    }
    @media (min-width: 300px) and (max-width: 760px ){
        .link-holder {
            width: 70px;
        }
        .pl-sm-0 {
            padding-left: 0;
        }
        .w-sm-100 {
            width: 100% !important;
        }
        .pr-sm-0 {
            padding-right: 0;
        }
        .d-sm-block {
            display: block;
        }
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
                children: [],
                selectedCoin: 'All',
                tableType: 'sell'
            }
        },
        created () {
            window.axios.get('/api/offers/payment-methods')
                .then(res => {
                    let data = [...res.data];
                    data.forEach (method => {
                        this.children.push(...method.children);
                        method.children = method.children.map(child => {
                            return {
                                id: child.id,
                                text: child.name
                            }
                        })
                        this.paymentMethods.push({
                            id : method.id,
                            text : method.name,
                            children: [...method.children]
                        })
                    });
                    this.paymentMethods.unshift({id: 'all', text: 'All Payment Methods'});
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
