<template>
    <div>
        <v-client-table v-if="tableType === 'sell'" ref="table" :data="tableData" :columns="sellColumns" :options="options">
            <div slot="seller" slot-scope="props" class="user-tag h-50p d-flex align-items-center">
                <span class="media-left d-none d-sm-block pr-1">
                    <span  class="avatar avatar-md rounded-circle avatar-off">
                        <img  src="http://expresscargo.me/images/objects/avatar.png" width="50px" height="50px" style="border-radius: 50%;" alt="avatar">
                        <i ></i>
                    </span>
                </span>
                <div>
                    <div class="">
                        <a  :href="`/profile/${props.row.seller}`" class="media-heading text-capitalize">{{ props.row.seller }}</a><br >
                    </div>
                    <div class="blue-grey font-small-3 lighten-2 alert-primary">
                        {{ props.row.user.status }}
                    </div>
                </div>
            </div>
            <div slot="coin" class="h-50p d-flex justify-content-center align-items-center" slot-scope="props"><p>{{ props.row.coin }}</p></div>
            <div slot="payment_method" class="h-50p d-flex justify-content-center align-items-center" slot-scope="props"><p>{{ props.row.payment_method }}</p></div>
            <div slot="amount_range" slot-scope="props" class="d-flex h-50p justify-content-center align-items-center"><strong>{{ props.row.amount_range }}</strong></div>
            <div slot="action" slot-scope="props" class="d-flex h-50p justify-content-center align-items-center" >
                <a :href="`/home/offer/${props.row.token}`" class="btn btn-primary px-2">Buy</a>
            </div>

        </v-client-table>

        <v-client-table v-if="tableType === 'buy'" ref="table" :data="tableData" :columns="buyColumns" :options="options">
            <div slot="buyer" slot-scope="props" class="user-tag h-50p d-flex align-items-center">
                <span class="media-left d-none d-sm-block pr-1">
                    <span  class="avatar avatar-md rounded-circle avatar-off">
                        <img  src="http://expresscargo.me/images/objects/avatar.png" width="50px" height="50px" style="border-radius: 50%;" alt="avatar">
                        <i ></i>
                    </span>
                </span>
                <div>
                    <div class="">
                        <a :href="`/profile/${props.row.seller}`" class="media-heading text-capitalize">{{ props.row.buyer }}</a><br >
                    </div>
                    <div class="blue-grey font-small-3 lighten-2 alert-primary">
                        {{ props.row.user.status }}
                    </div>
                </div>
            </div>
            <div slot="coin" class="h-50p d-flex justify-content-center align-items-center" slot-scope="props"><p>{{ props.row.coin }}</p></div>
            <div slot="payment_method" class="h-50p d-flex justify-content-center align-items-center" slot-scope="props"><p>{{ props.row.payment_method }}</p></div>
            <div slot="amount_range" slot-scope="props" class="d-flex h-50p justify-content-center align-items-center"><strong>{{ props.row.amount_range }}</strong></div>
            <div slot="action" slot-scope="props" class="d-flex h-50p justify-content-center align-items-center" >
                <a :href="`/home/offer/${props.row.token}`" class="btn btn-primary px-2">Sell</a>
            </div>
        </v-client-table>
    </div>
    <!--<div class="">
      <div style="overflow-x:auto;">
          <table class="table table-hover table-responsive responsive" id="tableView" style="">
              <thead>
                  <tr>
                      <th>Seller</th>
                      <th>Payment Method</th>
                      <th>Price(N)</th>
                      <th>Price{BTC}</th>
                      <th>Limit{BTC}</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td><button class="btn btn-purple" style="width:100px!important; margin:0px!important">Sell Bitcoin</button></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Bitcoin Trader (30+, 100%)</td>
                      <td>National Bank Transfer</td>
                      <td>N2,061,436.00</td>
                      <td>$3700.89</td>
                      <td>0.3 - 100</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td colspan="6" class="show-more">Show More</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>-->
</template>

<script>
    export default {
        name: 'TableView',
        props: ['paymentMethod', 'paymentMethods', 'tableType'],
        data () {
            return {
                tableData: [],
                sellData: [],
                buyData: [],
                sellColumns: ['seller', 'payment_method', 'coin', 'amount_range', 'action'],
                buyColumns: ['buyer', 'payment_method', 'coin', 'amount_range', 'action'],
                options: {
                    perPage: 10,
                    filterable: false,
                    sortable: ['payment_method', 'amount_range'],
                    skin: "table mytable table-bordered table-hover",
                }
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
            }
        },
        created () {
            window.axios.get(`/api/offers/test-sell`)
                .then(res => {
                    let response = [];
                    for (let data in res.data.data) {
                        if (res.data.data.hasOwnProperty(data))
                            response.push(res.data.data[data]);
                    }
                    response.forEach (data => {
                        let seller = data.user.name;
                        let user = data.user;
                        let token = data.token;
                        let payment_method = data.payment_method;
                        let maxAmount = data.max_amount;
                        let minAmount = data.min_amount;
                        let coin = data.coin.toUpperCase();
                        this.sellData.push({seller, payment_method , coin, amount_range: `$${minAmount} - $${maxAmount}`, user, token});
                    });
                    this.tableData = [...this.getCurrentTableData()];
                })
                .catch(err => {
                    console.error(err);
                })
            ;

            window.axios.get(`/api/offers/test-buy`)
                .then(res => {
                    let response = [];
                    for (let data in res.data.data) {
                        if (res.data.data.hasOwnProperty(data))
                            response.push(res.data.data[data]);
                    }
                    response.forEach (data => {
                        let buyer = data.user.name;
                        let user = data.user;
                        let token = data.token;
                        let payment_method = data.payment_method;
                        let maxAmount = data.max_amount;
                        let minAmount = data.min_amount;
                        let coin = data.coin.toUpperCase();
                        this.buyData.push({buyer, payment_method , coin, amount_range: `$${minAmount} - $${maxAmount}`, user, token});
                    });
                    this.tableData = [...this.getCurrentTableData()];
                })
                .catch(err => {
                    console.error(err);
                })
            ;
        },
        mounted () {
            this.tableData = [...this.getCurrentTableData()];
        },
        methods: {
            getCurrentTableData () {
                if (this.tableType === 'buy') {
                    return this.buyData;
                } else {
                    return this.sellData;
                }
            }
        }
    };
</script>

<style>
  .VuePagination {
    margin: 0px !important;
    padding: 0px !important;
  }
</style>
