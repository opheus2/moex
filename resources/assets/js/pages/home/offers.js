import PerfectScrollbar from "perfect-scrollbar";
import InfiniteLoading from "vue-infinite-loading";


export default {
    data: function () {
        return Object.assign({
            ratings: {
                total: 0,
                data: [],
                current: 0,
                next: true,
            },

            coinValue: 0,
            amount: 0,
            usd_amount:0,
        }, window._vueData)
    },

    mounted: function () {
        this.$nextTick(function () {
            if (this.profile !== undefined) {
                this.listenProfilePresence();
                this.handleScrollElements();
            }
        })
    },

    methods: {
        listenProfilePresence: function () {
            let vm = this;

            if (vm.profile.id !== undefined) {
                Echo.private('user.' + vm.profile.id + '.presence')
                    .listen('UserPresenceUpdated', function (e) {
                        vm.profile.presence = e.presence;
                        vm.profile.lastSeen = e.last_seen;
                    });
            }
        },

        handleScrollElements: function () {
            if(this.$refs.ratingScrollWrapper){
                new PerfectScrollbar(this.$refs.ratingScrollWrapper);
            }
        },

        dateDiffForHumans: function(date){
            let localTime = moment.utc(date).toDate();

            return moment(localTime).fromNow();
        },

        ratingInfiniteHandler: function ($state) {
            let vm = this;

            if (this.ratings.next) {
                const endpoint = route('ajax.profile.get-ratings', {
                    'user': vm.offer.user.name
                });

                axios.post(endpoint, {
                    page: vm.ratings.current + 1,
                }).then(function (response) {
                    var ratings = response.data;

                    if (ratings.data.length && vm.ratings.next) {
                        vm.ratings.current = ratings.current_page;
                        vm.ratings.data = vm.ratings.data.concat(ratings.data);
                        vm.ratings.next = Boolean(ratings.next_page_url);
                        vm.ratings.total = ratings.total;
                    } else {
                        vm.ratings.next = false;
                    }

                    $state.loaded();

                    if (!vm.ratings.next) {
                        $state.complete();
                    }
                }).catch(function (error) {
                    if (error.response) {
                        let response = error.response.data;

                        if ($.isPlainObject(response)) {
                            $.each(response.errors, function (key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error(response);
                        }

                        vm.ratings.next = false;

                        $state.complete();
                    } else {
                        console.log(error.message);
                    }
                });
            } else {
                $state.complete();
            }
        },
        amountCon: function (value) {
        //     this.coinValue  = parseFloat((value.key / this.rate).toFixed(8));
        //     this.usd_amount = parseFloat((value.key / this.cur_rate).toFixed(2));

        //     console.log(value)

        //     return [this.coinValue] [this.usd_amount];
        },

        coinCon: function (value) {
        //     this.amount     = parseFloat((value.key * this.rate).toFixed(2));
        //     this.usd_amount = parseFloat((value.key * this.usd_rate).toFixed(2));
        //     console.log(value.key)

        //     return [this.amount] [this.usd_amount];
        },

        usdCon: function (value) {
        //     this.amount     = parseFloat((value.key * this.cur_rate).toFixed(2));
        //     this.coinValue  = parseFloat((value.key / this.usd_rate).toFixed(8));

        //     return this.amount;
        }

    },

    watch: {
        amount: function (value) {
            // this.coinValue  = parseFloat((value / this.rate).toFixed(8));
            // this.usd_amount
            // this.usd_amount = parseFloat((value / this.cur_rate)).toFixed(2);
            // console.log('amount' + value)
        },

        coinValue: function (value) {
            this.amount     = parseFloat((value * this.rate).toFixed(2));
            this.usd_amount = parseFloat((value * this.usd_rate).toFixed(2));
        },

        usd_amount: function (value) {
            // this.amount     = parseFloat((value * this.cur_rate).toFixed(2));
            // console.log('usd' + value)

            // this.coinValue = parseFloat((value * this.cur_rate).toFixed(8));
            // this.amount = parseFloat((value / this.rate).toFixed(8));
        }
    },

    computed: {
        lastSeenPresence: function () {
            let lastSeen = 'Not Available!';

            if (this.profile.lastSeen) {
                let localTime = moment.utc(this.profile.lastSeen).toDate();

                lastSeen  = 'Seen ' + moment(localTime).fromNow();
            }

            return lastSeen;
        },

        avatarPresenceObject: function () {
            return {
                'avatar-off': this.profile.presence === 'offline',
                'avatar-online': this.profile.presence === 'online',
                'avatar-away': this.profile.presence === 'away',
            }
        }
    },

    components: {InfiniteLoading},
}
