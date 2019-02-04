<template>
    <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
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
    // const BASEURL = "http://expresscargo.me/api";

    export default {
        name: 'TableView',
        props: ['paymentMethod', 'paymentMethods'],
        data () {
            return {
                tableData: [],
                originalData: [],
                columns: ['seller', 'paymentMethod', 'nairaPrice', 'dollarPrice', 'limit'],
                options: {
                    perPage: 2,
                    filterable: false
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
                this.tableData = this.originalData.filter(data => {return data.paymentMethod === method.name});
                // debugger
            }
        },
        created () {
            window.axios.get(`/api/offers/test-sell`)
                .then(res => {
                    // console.log([...res.data.data]);
                    console.log(typeof res.data.data);
                    let response = [];
                    for (let data in res.data.data) {
                        if (res.data.data.hasOwnProperty(data))
                            response.push(res.data.data[data]);
                    }
                    response.forEach (data => {
                        let seller = data.user.name;
                        let paymentMethod = data.payment_method;
                        let nairaPrice = 20000000;
                        let dollarPrice = 1000;
                        let maxAmount = data.max_amount;
                        let minAmount = data.min_amount;
                        this.tableData.push({seller, paymentMethod, nairaPrice, dollarPrice, limit: `${minAmount} - ${maxAmount}`});
                        this.originalData =[...this.tableData];
                    })



                })
                .catch(err => {
                    console.error(err);
                })
            ;
        }
    };
</script>

<style lang="css" scoped>
</style>
