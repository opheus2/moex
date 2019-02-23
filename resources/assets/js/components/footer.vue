<template>

<footer>
    <div class="container-fluid main-footer ">
        <section id="contact-group" class="visible-xs-block md-show col-xs-12 col-md-3">
        	<div class="col-xs-12 h-100 px-0" style="margin-bottom:20px;">
    				<h4>GET UPDATES FROM US</h4>
    				<div class="input-group">
	            <input type="text" class="form-control" placeholder="Type Email Address">
	            <span class="input-group-btn">
              	<button class="btn btn-moex" type="button">Send</button>
	            </span>
		        </div>
    			</div>
        </section>
        <section class="col-xs-12 mt-xs-2 pr-xs-0 col-md-9">
        	<div class="col-xs-12  px-0 col-md-6">
        		<div class="col-xs-6 pl-0 col-md-6">
		            <h4>MyOwnexchange</h4>
		            <p> &copy; 2019 - 2023, MOEX</p>
	                <p>Babylon Solutions Limited</p>
	                <p>Seychelles Reg. No. 168830</p>
		        </div>
		        <div class="col-xs-6 col-md-6">
		            <ul class="footer-list">
		                <li><h4 class="text-white">About</h4></li>
		                <li><router-link to="/landing/careers"><p class="text-white">Careers</p></router-link></li>
		                <li><router-link to="/landing/terms-of-service"><p class="text-white">Terms of Service</p></router-link></li>
		                <li><router-link to="/landing/privacy-policy"><p class="text-white">Privacy Policy</p></router-link></li>
		                <li><router-link to="/landing/blog"><p class="text-white">Blog</p></router-link></li>
		            </ul>
		        </div>
        	</div>
        	<div class="col-xs-12 px-xs-0 mt-xs-2 col-md-6">
        		<div class="col-xs-6 pl-xs-0 col-md-6 mv-left">
		            <ul class="footer-list">
		                <li><h4 class="text-white">Support</h4></li>
		                <li><router-link to="/landing/contact"><p class="text-white"> Contact Us</p></router-link></li>
		                <li><router-link to="/landing/faq"><p class="text-white">FAQ</p></router-link></li>
		                <li><router-link to="/landing/api"><p class="text-white">API Documention</p></router-link></li>
		            </ul>
		        </div>
		        <div class="col-xs-6 col-md-6">
		            <ul class="footer-list">
		                <li><h4 class="text-white">Social</h4></li>
		                <li><p class="text-white">Facebook</p></li>
		                <li><p class="text-white">Twitter</p></li>
		                <li><p class="text-white">Linkedln</p></li>
		                <li><p class="text-white">Instagram</p></li>
		            </ul>
		        </div>
        	</div>

        </section>
        <section id="contact-group" class="hidden-xs hide-md px-0 col-xs-12 col-md-3">
        	<div class="col-xs-12 h-100 " style="margin-top:30%;">
      				<h6>Get updates from us</h6>
      				<div class="input-group">
		             <input type="text" class="form-control" placeholder="Type Email Address">
		            <span class="input-group-btn">
	                	<button class="btn btn-moex" type="button">Send</button>
		            </span>
		        </div>
			    </div>
        </section>
    </div>
    <div class="container-fluid">
    	<div class="col-xs-12 col-md-12">
    		<hr  style="border: 1px solid rgba(218, 218, 218, 0.43);">
    	</div>
        <div class="col-md-12 px-0 foot">
            <p class="col-xs-8 col-md-9">&copy; 2019 MOEX. All rights reserved.</p>
            <p class="col-xs-4 col-md-3" style="margin-left: auto; text-align: right; cursor: pointer;" @click="scrollToTop"> Back to top</p>
        </div>
    </div>
</footer>
</template>

<style scoped>
	.btn-moex {
		background-color: #6C63FF;
		color: #ffffff;
	}
    .text-white {
       color: white;
    }
    .px-0 {
    	padding-right: 0px;
    	padding-left: 0px;
    }
    .pr-0 {
    	padding-right: 0px;
    }
    .pl-0 {
    	padding-left: 0px;
    }
    footer{
    	padding: 30px;
    }
    .main-footer {
    	min-height: 200px;
    }
    .main-footer section {
    	height: 100%;
    }
    .main-footer section:last-of-type {
    	display: flex;
    	flex-direction: column;
    	justify-content: flex-end;
    }
    footer p {
		font-family: Nunito;
		font-style: normal;
		font-weight: 300;
		font-size: 14px;
		opacity: 0.7;
		letter-spacing: 0.02em;
	}
	footer p:hover {
		opacity: 1;
	}
	footer a {
		text-decoration: none;
	}
	footer h4 {
		margin-bottom: 1.5rem;
		font-size: 19px;
	}

	/* Desktops and laptops ----------- */
	@media only screen
	and (min-width : 1224px) {
		.px-md-0 {
			padding-right: 0px;
			padding-left: 0px;
		}
	}

  @media only screen
  and (min-width: 481px)
  and (max-width: 991px) {
    .mv-left {
      padding-left: 0px !important;
      margin-left: -55px;
      margin-right: 55px;
    }
    .visible-xs-block {
        display: block!important;
    }
    .hide-md {
      display:none!important;
    }
  }

    /* Smartphones (portrait and landscape) ----------- */
    @media only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px) {
    	footer {
    		padding: 0px;
    		padding-top: 10px;
    	}
    	.main-footer {
    		height: auto;
    	}
    	footer ul {
    		padding-left: 0px;
    	}
    	footer p {
			font-size: 12px;
			letter-spacing: 0.01em;
    	}
    	.px-xs-0 {
    		padding-left: 0px !important;
    		padding-right: 0px !important;
    	}
    	.pr-xs-0 {
    		padding-right: 0px !important;
    	}
		.pl-xs-0 {
    		padding-left: 0px !important;
    	}
    	.mt-xs-2 {
    		margin-top: 1rem;
    	}
    }
</style>
<script>
	export default ({
		methods: {
			scrollToTop () {
				window.scrollTo(0,0);
			}
		}
	})
</script>
