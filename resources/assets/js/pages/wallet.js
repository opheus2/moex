export default {
    data: function () {
        return {
            send: {
                btc_value: 0,
                dash_value: 0,
                ltc_value: 0
            }
        }
    },
    mounted () {
        let interval = setInterval(() => {
            if (document.head.parentElement.classList.contains('loaded')) {
                if (window.location.hash.trim() ) {
                    document.querySelector(`${window.location.hash}-tab`).click()
                }
                clearInterval(interval);
            }

        }, 10);
        /*setTimeout(() => {
            alert(window.location.hash);
        }, 100)*/
    }
}
