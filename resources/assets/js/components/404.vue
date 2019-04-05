<template>
    <section>
        <div class="error-div">
        <div class="">
            <div class="d-flex justify-content-center">
                <img src="/images/404.svg" alt="404" style="width:50%; height:50vh">
            </div>
            <p class="error-message">Oh No! Seems this page is broken</p>
            <div class="" style="width:100%; text-align:center">
                <router-link :to="{name: 'land'}">Go Back</router-link>
            </div>
        </div>
        </div>
        <div class="trading">
            <div class="">
                <p>Start Trading</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis luctus sodales. </p>
                <div class="d-flex justify-content-center">
                    <a class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a>
                </div>
            </div>
        </div>
    </section>
    
</template>

<script>
export default {

}
</script>

<style>

</style>
