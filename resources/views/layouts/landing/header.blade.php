<nav id="navbar" class="navbar header-bg">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" onclick="openNav()" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand header-brand"  href="#">MOEX</a>
    </div>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a class="text-color" href="#">Buy Bitcoins</a>    
      <a class="text-color" href="#">Sell Bitcoins</a>    
      <a class="text-color" href="#">Forums</a>    
      <a class="text-color" href="#">About</a>  
      <a class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a>  
</div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right header-links">
        <li><a class="text-color" href="#">Buy Bitcoins</a></li>
        <li><a class="text-color" href="#">Sell Bitcoins</a></li>
        <li><a class="text-color" href="#">Forums</a></li>
        <li><a class="text-color" href="#">About</a></li>
        <li><a class="text-color btn btn-default btn-lg button-sign" href="#">Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  // document.getElementById("main").style.marginLeft = "250px";
  // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  // document.getElementById("main").style.marginLeft= "0";
  // document.body.style.backgroundColor = "white";
}
</script>