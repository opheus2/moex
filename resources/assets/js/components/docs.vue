<template>
<div class="">
  <div class="banner">
      <div class="row center">
          <h6 class="policy">API Documentation</h6>
          <h6 class="read">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia, est eleifend scelerisque tristique.</h6>
      </div>
  </div>
  <div class="containers">
    <div class="api-inner">
      <div class="api-flex-tab container-fluid">
        <div class="row">
          <div class="left col-xs-12 col-md-4">
            <p class="title">Table of content</p>
            <div class="list-group">
              <a href="#" class="list-group-item active">General</a>
              <a href="#" class="list-group-item">Blogs &amp; Posts</a>
              <a href="#" class="list-group-item">Fees &amp; Charges</a>
              <a href="#" class="list-group-item">Safety &amp; Security</a>
              <a href="#" class="list-group-item">Mobile App</a>
              <a href="#" class="list-group-item">More Questions?</a>
            </div>
          </div>
          <div class="right col-xs-12 col-md-8">
            <p class="title">General</p>
            <p class="body">
              t is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here, content here',
              making it look like readable English. Many desktop publishing packages and web page editors now
              use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
              web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
              sometimes on purpose (injected humour and the like).<br><br>
              t is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here, content here',
              making it look like readable English. Many desktop publishing packages and web page editors now
              use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
              web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
              sometimes on purpose (injected humour and the like).<br><br>
              t is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here, content here',
              making it look like readable English. Many desktop publishing packages and web page editors now
              use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
              web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
              sometimes on purpose (injected humour and the like).<br><br>
              t is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here, content here',
              making it look like readable English. Many desktop publishing packages and web page editors now
              use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
              web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
              sometimes on purpose (injected humour and the like).<br><br>
              t is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here, content here',
              making it look like readable English. Many desktop publishing packages and web page editors now
              use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many
              web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
              sometimes on purpose (injected humour and the like).<br><br>
            </p>
          </div>
        </div>
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
