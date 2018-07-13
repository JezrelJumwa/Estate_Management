<body> 
	<!-- wpf loader Two -->
	<!--<div id="wpf-loader-two">          
		<div class="wpf-loader-two-inner">
			<span>Loading</span>
		</div>
	</div> -->
    <!-- / wpf loader Two --> 
          
	<!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
	<!-- END SCROLL TOP BUTTON -->    
    
    <!-- Start header section -->
	<header id="aa-header">
		<!-- start header top  -->
		<div class="aa-header-top">
			<!--<div class="container">
				<div class="row">
					<!-<div class="col-md-12">
							<div class="aa-header-top-area">
								<!- start header top left ->
								<div class="aa-header-top-left">
									<!- start language ->
									<div class="aa-language">
										<div class="dropdown">
											<a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												<img src="img/flag/english.jpg" alt="english flag">ENGLISH
												<span class="caret"></span>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
												<li><a href="#"><img src="img/flag/french.jpg" alt="">FRENCH</a></li>
												<li><a href="#"><img src="img/flag/english.jpg" alt="">ENGLISH</a></li>
											</ul>
										</div>
									</div>
									<!- / language ->

									<!- start currency ->
									<div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fa fa-usd"></i>USD
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                      <li><a href="#"><i class="fa fa-jpy"></i>YEN</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / currency ->
                <!-- start cellphone ->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>00-62-658-658</p>
                </div>
                <!- / cellphone ->
              </div>
              <!- / header top left ->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <li><a href="account.html">My Account</a></li>
                  <li class="hidden-xs"><a href="wishlist.html">Wishlist</a></li>
                  <li class="hidden-xs"><a href="cart.html">My Cart</a></li>
                  <li class="hidden-xs"><a href="checkout.html">Checkout</a></li>
                  <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                </ul>
              </div>
            </div>
          </div>-->
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="<?php echo $url; ?>">
                  <span class=""></span>
                  <p><img src="./img/image_4.png" style="padding: 0px; marging: 0px;" height="70" /> RENT <strong>MANAGEMENT</strong><span></span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
              <!--<div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <span class="aa-cart-notify">2</span>
                </a>
                <div class="aa-cartbox-summary">
                  <ul>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="img/woman-small-2.jpg" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">Product Name</a></h4>
                        <p>1 x Kshs 250</p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>
                    <li>
                      <a class="aa-cartbox-img" href="#"><img src="img/woman-small-1.jpg" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#">Product Name</a></h4>
                        <p>1 x Kshs 250</p>
                      </div>
                      <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                    </li>                    
                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        Kshs 500
                      </span>
                    </li>
                  </ul>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                </div>
              </div>-->
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  
<!-- menu -->
<section id="menu">
    <div class="container">
        <div class="menu-area">
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>          
                </div>
                <div class="navbar-collapse collapse">
                    <!-- Left nav -->
                    <ul class="nav navbar-nav nav-left">
			             <li>&nbsp;</li>
			         </ul>
			         <ul class="nav navbar-nav nav-right">
                        <?php
                            if(isset($uid) && $uid !=="" && $change_pass == 0){
                                echo "<li><a>Welcome: <span>" . $user->usernames() . "</span></a></li>";
                            }
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>       
    </div>
</section>
<!-- / menu -->
