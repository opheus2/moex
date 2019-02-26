<template>
    <div>
        <div class="jumbotron">
            <div class="landing-buy text-color">
                <div class="w-93">
                    <span>Buy and Sell Bitcoins Easily</span>
                    <h6>exchange your bitoins for cash in minutes easily. It's safe, relaible and fast!. </h6>
                    <a style="" class="text-color btn btn-default btn-lg button-sign" href="/register">Sign Up</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="about">
                <div class="left mt-5">
                    <h4 class="title">WHAT TO KNOW</h4>
                    <h6 class="subtitle">MOEX is a peer to peer exchange service provider that allows you to trade your cryptocurrencies such as Bitcoin, Litecoin and other types of cryptocurrency with an escrow fee of just 1% with no fees for selling.</h6>
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
                            <select2 v-model="selectedPaymentMethod" :options="paymentMethods"/>
                        </div>
                        <div class="button-group sm-hide">
                            <select class="form-control" disabled>
                                <option>In Nigeria</option>
                            </select>
                            <!-- <button class="btn btn-white">In Nigeria</button> -->
                        </div>
                    </div>
                    <div class="d-flex child">
                        <div class="button-group">
                            <button @click="tableType = 'sell'" class="btn" :class="tableType === 'sell' ? 'btn-purple' : 'btn-white'">Sell Bitcoin</button>
                        </div>
                        <div class="button-group">
                            <button @click="tableType = 'buy'" class="btn" :class="tableType === 'buy' ? 'btn-purple' : 'btn-white'">Buy Bitcoin</button>
                        </div>
                        <div class="button-group lg-hide" style="float:right; margin-left: 5px; ">
                            <select class="form-control" disabled>
                                <option>In Nigeria</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table-view :tableType="tableType" :paymentMethod="selectedPaymentMethod" :paymentMethods="children"></table-view>
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
                    <p class="us">Join Us</p><br>
                    <span class="text">Like what you see and want to be a part of this amazing community of bitcoin traders? Then sign up today.</span>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="button-group">
                        <a class="btn btn-purple signup" href="/register">SIGN UP</a>
                        <a class="btn btn-white login"  href="/login">SIGN IN </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>

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
