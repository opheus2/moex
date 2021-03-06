export default {
    data: function () {
        return Object.assign({
            payment_method: '',
            min_amount: 1,
            max_amount: 1000,
            coin: 'btc',
            profit_margin: 5,
            // btc_min: 0,
            // btc_max: 0,    
            // ltc_min: 0,   
            // ltc_max: 0,   
            // dash_min: 0,  
            // dash_max: 0,  
        }, window._vueData);
    },


    methods: {
        formatAmount: function (value) {
            let currency = (this.currency) ? this.currency : 'USD';

            return new Intl.NumberFormat(this.locale, {
                style: 'currency', currencyDisplay: 'symbol', currency: currency
            }).format(value);
        },

       
    },

    computed: {
        totalPrice: function () {
            return (this.totalPercent * this.coinPrice) / 100;
        },

        netAmount: function () {
            return Math.abs(this.totalPrice - this.coinPrice);
        },

        totalPercent: function () {
            let margin = 0;

            if (this.profit_margin) {
                margin = this.profit_margin;
            }

            return 100 + margin;
        },

        minAmount: function(value){
            console.log(this.btc_min);


            if( this.coin === 'btc' ){

                this.min_amount = this.btc_min.toFixed(8)

            } else if( this.coin === 'ltc'){

                this.min_amount = this.ltc_min.toFixed(8)

            } else if( this.coin === 'dash'){

                this.min_amount = this.dash_min.toFixed(8)

            }

            return this.min_amount;
        },

        maxAmount: function(value){


            if( this.coin === 'btc' ){

                this.max_amount = this.btc_max.toFixed(8)

            } else if( this.coin === 'ltc'){

                this.max_amount = this.ltc_max.toFixed(8)

            } else if( this.coin === 'dash'){

                this.max_amount = this.dash_max.toFixed(8)

            }

            console.log(this.max_amount);

            return this.max_amount;
        },

        coinPrice: function () {
            let currency = (this.currency) ? this.currency : 'USD';
            let coin     = (this.coin) ? this.coin : 'BTC';
            
            return this.coin_prices[coin.toUpperCase()][currency.toUpperCase()];
        },
    }
}
