<template>
  <nav id="navbar" class="navbar header-bg" :class="`${$route.path === '/landing' ? 'mynavbar': ''}`">
    <div class="w-93">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" @click="openNav()" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <router-link to="/" class="navbar-brand header-brand"><img src="/images/logo/logo-dark.png" alt="logo-large" class="logo-lg"></router-link>
      </div>
      <div id="mySidenav" class="sidenav">
        <ul>
          <li><a href="javascript:void(0)" class="closebtn" @click="closeNav()">&times;</a></li>
          <li><a class="text-color" href="/login">Buy Bitcoins</a>  </li>
          <li><a class="text-color" href="/login">Sell Bitcoins</a> </li>
          <li><router-link :to="{name: 'blog'}" class="text-color" >Blog</router-link></li>
          <li><router-link :to="{name: 'about'}" class="text-color">About</router-link></li>
          <li>
            <a class="btn btn-purple signup" href="/login" v-if="isOffline">Sign In</a>
            <a class="btn btn-purple signup" href="/home" v-else>Dashboard</a>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right header-links">
          <li><a class="text-color" href="/login">Buy Bitcoins</a></li>
          <li><a class="text-color" href="/login">Sell Bitcoins</a></li>
          <li><router-link :to="{name: 'blog'}" class="text-color" >Blog</router-link></li>
          <li><router-link :to="{name: 'about'}" class="text-color">About</router-link></li>
          <li>
            <a class="landing-custom btn btn-purple signup" href="/login" v-if="isOffline">Sign In</a>
            <a class="landing-custom btn btn-purple signup" href="/home" v-else>Dashboard</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</template>
<script>
  export default({
    data() {
      return {
        isOffline: true,
      }
    },
    mounted() {
      this.isOffline = window._isOffline;
    },
    methods: {
      closeNav() {
        document.getElementById("mySidenav").style.width = "0px";
      },
      openNav() {
        document.getElementById("mySidenav").style.width = "220px";
      }
    }
  })
</script>
