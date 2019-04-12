<template>
    <div class="table-view">
        <v-client-table v-if="tableType === 'sell'" ref="table" :data="tableData" :columns="sellColumns" :options="options">
            <div slot="seller" slot-scope="props" class="user-tag d-flex">
                <a style="color: black; margin-top: 3px"  :href="`/profile/${props.row.user.name}`" class="text-capitalize">
                    {{`${props.row.user.name} (${props.row.avgRating.toFixed(1)}%)` }}
                </a>
                <div class="notif" :class="props.row.user.status === 'active' ? 'bg-green' : 'bg-orange'"><i></i></div>
                <div class="notif" v-if="props.row.isVerified">
                    <span class="fa-stack">
                        <i class="fas fa-certificate fa-stack-2x" style="color:#6C63FF"></i>
                        <i class="fas fa-check fa-stack-1x" style="color:white"></i>
                    </span>
                </div>
            </div>
            <div slot="price_NGN" class="d-flex align-items-center" slot-scope="props">
                <p>&#8358;{{ ((props.row.otherDetails.profit_margin / 100 * btcNGN) + btcNGN).toFixed(2) }}</p>
            </div>
            <div slot="price_USD" slot-scope="props" class="d-flex align-items-center">
                <strong>${{ ((props.row.otherDetails.profit_margin / 100 * btcUSD) + btcUSD).toFixed(2) }}</strong>
            </div>
            <div slot="payment_method" class="d-flex align-items-center" slot-scope="props"><p>{{ props.row.payment_method }}</p></div>
            <div slot="limit" slot-scope="props" class="d-flex align-items-center"><strong>{{ props.row.amount_range }}</strong></div>
            <div slot="action" slot-scope="props" class="d-flex align-items-center" style="width: 30px;" >
                <a :href="`/home/offer/${props.row.token}`" class="btn mybtn btn-purple px-2">Buy</a>
            </div>

        </v-client-table>

        <v-client-table v-if="tableType === 'buy'" ref="table" :data="tableData" :columns="buyColumns" :options="options">
            <div slot="buyer" slot-scope="props" class="user-tag d-flex">
                <a style="color: black; margin-top: 3px"  :href="`/profile/${props.row.user.name}`" class="text-capitalize">
                    {{ `${props.row.user.name} (${props.row.avgRating.toFixed(1)}%) `}}
                </a>
                <div class="notif" :class="props.row.user.status === 'active' ? 'bg-green' : 'bg-orange'"><i></i></div>
                <div class="notif"  v-if="props.row.isVerified">
                    <span class="fa-stack">
                        <i class="fas fa-certificate fa-stack-2x" style="color:#6C63FF"></i>
                        <i class="fas fa-check fa-stack-1x" style="color:white"></i>
                    </span>
                </div>
            </div>
            <div slot="price_NGN" class="d-flex align-items-center" slot-scope="props">
                <p>&#8358;{{ ((props.row.otherDetails.profit_margin / 100 * btcNGN) + btcNGN).toFixed(2) }}</p>
            </div>
            <div slot="price_USD" slot-scope="props" class="d-flex align-items-center">
                <strong>${{ ((props.row.otherDetails.profit_margin / 100 * btcUSD) + btcUSD).toFixed(2) }}</strong>
            </div>
            <div slot="payment_method" class="d-flex align-items-center" slot-scope="props"><p>{{ props.row.payment_method }}</p></div>
            <div slot="limit" slot-scope="props" class="d-flex align-items-center"><strong>{{ props.row.amount_range }}</strong></div>
            <div slot="action" slot-scope="props" class="d-flex align-items-center" style="width: 30px;">
                <a :href="`/home/offer/${props.row.token}`" class="btn mybtn btn-purple px-2">Sell</a>
            </div>
        </v-client-table>
    </div>
</template>

<script>
    export default {
        name: 'TableView',
        props: ['paymentMethod', 'coin', 'paymentMethods', 'tableType'],
        data () {
            return {
                tableData: [],
                sellData: [],
                buyData: [],
                ratings: [],
                sellHeadings:{
                    seller: "seller",
                    payment_method: "Payment Method",
                    price_NGN: "Price(NGN)",
                    price_USD: "Price{USD}",
                    limit: "limit{BTC}",
                    action: "Action",
                },
                buyHeadings: {
                    buyer: "buyer",
                    payment_method: "Payment Method",
                    price_NGN: "Price(NGN)",
                    price_USD: "Price{USD}",
                    limit: "limit{BTC}",
                    action: "Action",
                },
                sellColumns: ['seller', 'payment_method', 'price_NGN', 'price_USD' ,'limit', 'action'],
                buyColumns: ['buyer', 'payment_method', 'price_NGN', 'price_USD' ,'limit', 'action'],
                options: {
                    perPage: 5,
                    filterable: false,
                    perPageValues: [],
                    texts: {
                        count: ' '
                    },
                    headings: this.sellHeadings,
                    sortable: [/* 'payment_method', 'amount_range', 'coin' */],
                    skin: /* "table mytable table-bordered table-hover" */ "table table-hover table-responsive responsive",
                },
                btcNGN: 0,
                btcUSD: 0,
                ltcNGN: 0,
                ltcUSD: 0,
            }
        },
        watch: {
            tableType () {
                this.tableData = [...this.getCurrentTableData()];
            },
            paymentMethod () {
                if (this.paymentMethod === "all") {
                    this.tableData = [...this.getCurrentTableData()];
                    return;
                }
                let method = this.paymentMethods.find(meth => meth.id === Number(this.paymentMethod));
                this.tableData = this.getCurrentTableData().filter(data => {return data.payment_method === method.name});
            },
            coin () {
                if (this.coin === "All") {
                    this.tableData = [...this.getCurrentTableData()];
                    this.sellHeadings.limit = `limit{BTC}`;
                    this.buyHeadings.limit = `limit{BTC}`;
                    return;
                } else {
                    this.sellHeadings.limit = `limit{${this.coin}}`;
                    this.buyHeadings.limit = `limit{${this.coin}}`;
                }
                this.tableData = this.getCurrentTableData().filter(data => {return data.coin.toUpperCase() === this.coin.toUpperCase()});
                this.$forceUpdate();
            }
        },
        created () {
            window.axios.get(`/api/offers/sell`)
                .then(res => {
                    let response = [];
                    
                    // The response comes as an object so we need to transform it to an array
                    
                    for (let data in res.data.data) {
                        if (res.data.data.hasOwnProperty(data)) {
                            response.push(res.data.data[data]);
                        }
                    }
                    
                    response.forEach (data => {
                        let seller = data.user.name;
                        let otherDetails = data;
                        let user = data.user;
                        let token = data.token;
                        let payment_method = data.payment_method;
                        let maxAmount = data.max_amount;
                        let minAmount = data.min_amount;
                        let avgRating = this.getPercentageRating(this.getAverage(data.user.id));
                        let coin = data.coin.toUpperCase();
                        let isVerified = Boolean(Number(data.email_verification)) && data.user.verified;
                        this.sellData.push({seller, payment_method, otherDetails, avgRating, isVerified, coin, amount_range: `${minAmount} - ${maxAmount}`, user, token});
                    });
                    this.tableData = [...this.getCurrentTableData()];
                })
                .catch(err => {
                    console.error(err);
                })
            ;

            window.axios.get(`/api/offers/buy`)
                .then(res => {
                    let response = [];
                    for (let data in res.data.data) {
                        if (res.data.data.hasOwnProperty(data))
                            response.push(res.data.data[data]);
                    }
                    response.forEach (data => {
                        let buyer = data.user.name;
                        let user = data.user;
                        let otherDetails = data;
                        let token = data.token;
                        let payment_method = data.payment_method;
                        let maxAmount = data.max_amount;
                        let minAmount = data.min_amount;
                        let coin = data.coin.toUpperCase();
                        let avgRating = this.getPercentageRating(this.getAverage(data.user.id));
                        let isVerified = Boolean(Number(data.email_verification)) && Boolean(Number(data.kyc_verification));
                        this.buyData.push({buyer, payment_method, isVerified, avgRating, otherDetails, coin, amount_range: `$${minAmount} - $${maxAmount}`, user, token});
                    });
                    this.tableData = [...this.getCurrentTableData()];
                })
                .catch(err => {
                    console.error(err);
                })
            ;

            window.axios.get(`/api/rate/btc/ngn`).then(res => {
                this.btcNGN = res.data;
                if (this.btcUSD === 0) {
                    this.btcUSD = this.btcNGN / 360;
                }
            }).catch();
            window.axios.get(`/api/rate/btc/usd`).then(res => {
                this.btcUSD = res.data;
                if (this.btcNGN === 0) {
                    this.btcNGN = this.btcUSD * 360;
                }
            }).catch();
            window.axios.get(`/api/rate/ltc/usd`).then(res => {
                this.ltcUSD = res.data;
                if (this.ltcNGN === 0) {
                    this.ltcNGN = this.ltcUSD * 360
                }
            }).catch();
            window.axios.get(`/api/rate/ltc/ngn`).then(res => {
                this.ltcNGN = res.data;
                if (this.ltcUSD === 0) {
                    this.ltcUSD = this.ltcNGN * 360;
                }
            }).catch();

        },
        mounted () {
            this.tableData = [...this.getCurrentTableData()];
        },
        methods: {
            /**
             * Return the right table data based on the selected table type
             * @returns {array}
             */
            getCurrentTableData () {
                if (this.tableType === 'sell') {
                    this.options.headings = this.buyHeadings;
                    return this.buyData;
                } else {
                    this.options.headings = this.sellHeadings;
                    return this.sellData;
                }
            },

            /**
             * A function to return tha average user rating
             * 
             * @param {string} id - The userId
             * 
             * @returns {number} Average rating of user
             */
            getAverage (id) {
                let rating = this.ratings.find(rate => rate.userId === id);
                if (rating) return rating;
    
                this.ratings.push({
                    userId: id,
                    rating: 0,
                })
                window.axios.get(`/api/rating/user/${id}/avg`)
                    .then(res => {
                        let rating = this.ratings.find(rate => rate.userId === id);
                        rating.rating = res.data;
                        this.sellData.forEach(data => {
                            if (data.user.id === id) {
                                data.avgRating = this.getPercentageRating(rating.rating);
                            }
                        });
                        this.buyData.forEach(data => {
                            if (data.user.id === id) {
                                data.avgRating = this.getPercentageRating(rating.rating);
                            }
                        });
                        return res.data;
                    })
                    .catch(err => {
                        console.error(err);
                    })
                ;
            },

            /**
             * Calculate the percentage based on an already computed average and a given length
             * 
             * @param {number} avg - The average rating
             * @param {int} length - The denominator
             * @returns {number} The percentage rating
             */
            getPercentageRating (avg, length = 5) {
                if (isNaN(Number(avg)) || avg === 0 || length === 0) {
                    return 0;
                }
                const percentile = 100;
                
                return avg / length * percentile;
            }
        }
    };
</script>

<style>
    .VuePagination {
        margin: 0px !important;
        padding: 0px !important;
    }
    .table-view {
        background-color: white;
        padding: 10px;
    }
    .table-view td > div {
        height: 30px;
    }
    .table-view td > div p {
        margin: 0;
    }
    .table-view th {
        font-size: 18px;
    }
    .table-view td {
        font-size: 16px;
    }
    .mybtn {
        height: 30px;
        padding: 3px 10px;
    }
    .notif {
        margin-top: 4px;
        margin-left: 5px;
        width: 19px;
        height: 19px;
        border-radius: 50%; 
        font-size: 10px;
    }
    .bg-green {
        background-color: #02d802;
    }
    .bg-blue {
        background-color: blue;
    }
    .bg-orange {
        background-color: orange;
    }
    .bg-red {
        background-color: red;
    }

    @media (min-width: 300px) and (max-width: 760px ){
        .table-view th {
            font-size: 16px;
        }
        .table-view td {
            font-size: 15px;
        }
        .mt-sm-2 {
            margin-top: 10px;
        }
    }
</style>
