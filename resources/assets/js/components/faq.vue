<template>
  <div class="">
    <div class="banner">
        <div class="row center">
            <h6 class="policy">Frequently Asked Questions</h6>
            <h6 class="read">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, est eleifend scelerisque tristique.</h6>
        </div>
    </div>
    <div class="containers">
      <div class="faq-inner">
        <div class="faq-flex-tab container-fluid">
          <div class="row">
            <div class="left col-xs-12 col-lg-3">
              <div class="list-group">
                <a href="#" class="list-group-item active">General</a>
                <a href="#" class="list-group-item">Blogs &amp; Posts</a>
                <a href="#" class="list-group-item">Fees &amp; Charges</a>
                <a href="#" class="list-group-item">Safety &amp; Security</a>
                <a href="#" class="list-group-item">Mobile App</a>
                <a href="#" class="list-group-item">More Questions?</a>
              </div>
            </div>
            <div class="right col-xs-12 col-lg-9">
              <button class="accordion" @click="accord">Section 1</button>
              <div class="panel">
                <p>Lorem ipsum...</p>
              </div>

              <button class="accordion">Section 2</button>
              <div class="panel">
                <p>Lorem ipsum...</p>
              </div>

              <button class="accordion">Section 3</button>
              <div class="panel">
                <p>Lorem ipsum...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="container-fluid bg">
        <div class="">
          <p class="bg-text">Start Trading</p>
          <p class="bg-text-2"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis luctus sodales. </p>
          <div align="center">
            <a class="text-color btn btn-default btn-lg button-sign" style="color:#6C63FF !important" href="#">Sign Up</a>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }

</script>
