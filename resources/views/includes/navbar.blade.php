
<nav id="navbar" class="navbar error-header">
  <div class="w-93">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" @click="openNav()" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <router-link to="/landing" class="navbar-brand header-brand">MOEX</router-link>
    </div>
    <div id="mySidenav" class="sidenav">
      <ul>
        <li><a href="javascript:void(0)" class="closebtn" @click="closeNav()">&times;</a></li>
        <li><a class="text-color" href="#">Buy Bitcoins</a>  </li>
        <li><a class="text-color" href="#">Sell Bitcoins</a> </li>
        <li><a class="text-color" href="#">Forums</a></li>
        <!-- <li><router-link to="/foo" class="text-color" href="#">About</router-link></li> -->
        <li><a class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a></li>
      </ul>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right header-links">
        <li><a class="text-color" href="/login">Buy Bitcoins</a></li>
        <li><a class="text-color" href="/login">Sell Bitcoins</a></li>
        <li><a class="text-color" href="/">Blog</a></li>
        <li><a class="text-color" href="/">About</a></li>
        <li><a class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>
