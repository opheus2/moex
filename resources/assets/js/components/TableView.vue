<template>
    <v-client-table ref="table" :data="tableData" :columns="columns" :options="options">
        <div slot="seller" slot-scope="props" class="user-tag d-flex">
            <!--<span class="media">-->
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

            <!--</span>
            <span class="blue-grey font-small-3 lighten-2">
                Seen 3 hours ago
            </span>-->
        </div>
    </v-client-table>
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
        props: ['paymentMethod', 'paymentMethods'],
        data () {
            return {
                tableData: [],
                originalData: [],
                columns: ['seller', 'payment_method', 'coin', 'amount_range'],
                options: {
                    perPage: 10,
                    filterable: false,
                    sortable: ['payment_method', 'amount_range'],
                    skin: "table table-white-space table-bordered row-grouping display icheck table-middle dataTable dtr-column collapsed"
                }
            }
        },
        watch: {
            paymentMethod () {
                if (this.paymentMethod === "all") {
                    this.tableData = [...this.originalData];
                    return;
                }
                let method = this.paymentMethods.find(meth => meth.id === Number(this.paymentMethod));
                this.tableData = this.originalData.filter(data => {return data.payment_method === method.name});
            }
        },
        created () {
            window.axios.get(`/api/offers/test-sell`)
                .then(res => {
                    console.log(typeof res.data.data);
                    let response = [];
                    for (let data in res.data.data) {
                        if (res.data.data.hasOwnProperty(data))
                            response.push(res.data.data[data]);
                    }
                    response.forEach (data => {
                        let seller = data.user.name;
                        let user = data.user;
                        let payment_method = data.payment_method;
                        let maxAmount = data.max_amount;
                        let minAmount = data.min_amount;
                        let coin = data.coin.toUpperCase();
                        this.tableData.push({seller, payment_method , coin, amount_range: `$${minAmount} - $${maxAmount}`, user});
                        this.originalData =[...this.tableData];
                    })
                })
                .catch(err => {
                    console.error(err);
                })
            ;
        },
        mounted () {
            setTimeout(() => {

            }, 500);
            /*let table = document.querySelector('VueTables__table');
            table.classList.remove('table-striped','table-bordered');
            table.classList.add('table-responsive responsive');*/
        }
    };
</script>

<style lang="css" scoped>
</style>
