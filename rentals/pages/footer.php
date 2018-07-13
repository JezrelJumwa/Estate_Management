        <script>
            $(document).ready(function() {
                var table = $('#example1').DataTable();
             
                $('#example1 tbody').on( 'click', 'tr', function () {
                    $(this).toggleClass('selected');
                } );
             
                $('#button').click( function () {
                    alert(table.rows('.selected').data().length +' row(s) selected');
                } );
            } );
            $('#confirm_password').on('keyup', function () {
            if ($('#password').val() === $('#confirm_password').val()) {
              $('#message').html('Matching').css('color', 'green');
            } else 
              $('#message').html('Not Matching').css('color', 'red');
          });
           //tooltip 
          $(function () {
            $('[data-toggle="tooltip"]').tooltip;
          });
          
            
        </script>      
        
        <!-- Subscribe section -->
<!--		<section id="aa-subscribe">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="aa-subscribe-area">
							<h3>Subscribe our newsletter </h3>
							<p></p>
							<form action="" method="" class="aa-subscribe-form">
								<input type="email" name="" id="" placeholder="Enter your Email">
								<input type="submit" value="Subscribe">
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>-->
		<!-- / Subscribe section -->

		<!-- footer -->  
		<footer id="aa-footer">
			<!-- footer bottom -->
			<div class="aa-footer-top">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="aa-footer-top-area">
								<div class="row">
									<div class="col-md-3 col-sm-6">
										<div class="aa-footer-widget">
											<h3>Main Menu</h3>
											<ul class="aa-footer-nav">
												<li><a href="<?php echo $url2; ?>"> Home</a></li>
<!--												<li><a href="<?php echo $url2; ?>buy.html">Buy</a></li>-->
												<li><a href="<?php echo $url2; ?>rent.html">Rent</a></li>
												<li><a href="<?php echo $url2; ?>contact.html">Contact</a></li>
												<li><a href="<?php echo $url2; ?>properties.html">Properties</a></li>
												<!--<li><a href="#">About Us</a></li>-->
<!--												<li><a href="<?php echo $url; ?>">Refresh</a></li>-->
												<!--<li><a href="#">Site Map</a></li>-->
												
											</ul>
										</div>
									</div>
									<!--<div class="col-md-3 col-sm-6">
										<div class="aa-footer-widget">
											<div class="aa-footer-widget">
												<h3>Knowledge Base</h3>
												<ul class="aa-footer-nav">
													<li><a href="#">Delivery</a></li>
													<li><a href="#">Returns</a></li>
													<li><a href="#">Services</a></li>
													<li><a href="#">Discount</a></li>
													<li><a href="#">Special Offer</a></li>
												</ul>
											</div>
										</div>
									</div>-->
									<!--<div class="col-md-3 col-sm-6">
										<div class="aa-footer-widget">
											<div class="aa-footer-widget">
												<h3>Useful Links</h3>
												<ul class="aa-footer-nav">
													<li><a href="#">Site Map</a></li>
													<li><a href="#">Wanted Services</a></li>
													<li><a href="#">Service Providers</a></li>
													<li><a href="#">FAQ</a></li>
												</ul>
											</div>
										</div>
									</div>-->
									<div class="col-md-3 col-sm-6">
										<div class="aa-footer-widget">
											<div class="aa-footer-widget">
												<h3>Contact Us</h3>
												<address>
													<p><?php echo $address['box'] . ", " . $address['code'] . ", "; ?></p>
                                                                                                        <p><?php echo $address['city'] . ", " . $address['country']; ?></p>
													<p><span class="fa fa-phone"></span><?php echo $contact['tel1'] ?></p>
													<p><span class="fa fa-envelope"></span><?php echo $email['info']; ?></p>
												</address>
												<div class="aa-footer-social">
													<a href="https://www.facebook.com/love.pike" target="_blank"><span class="fa fa-facebook"></span></a>
													<a href="https://twitter.com/?lang=en" target="_blank"><span class="fa fa-twitter"></span></a>
													<a href="#"><span class="fa fa-google-plus"></span></a>
													<a href="#"><span class="fa fa-youtube"></span></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer-bottom -->
			<div class="aa-footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="aa-footer-bottom-area">
                                                            <p>Developed by <a href="https://www.facebook.com/pike.love" target="_blank">Jezrel Jumwa</a></p>
									<div class="aa-footer-payment">
										<span class="fa fa-cc-mastercard"></span>
										<span class="fa fa-cc-visa"></span>
										<span class="fa fa-paypal"></span>
										<span class="fa fa-cc-discover"></span>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- / footer -->

		<!-- Login Modal -->  
		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">                      
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Login or Register</h4>
						<form class="aa-login-form" action="">
							<label for="">Username or Email address<span>*</span></label>
							<input type="text" placeholder="Username or email">
							<label for="">Password<span>*</span></label>
							<input type="password" placeholder="Password">
							<button class="aa-browse-btn" type="submit">Login</button>
							<label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
							<p class="aa-lost-password"><a href="#">Lost your password?</a></p>
							<div class="aa-register-now">
								Don't have an account?<a href="account.html">Register now!</a>
								</div>
						</form>
					</div>                        
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>    

		<!-- jQuery library ->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!- Include all compiled plugins (below), or include individual files as needed ->
		<script src="<?php echo $url; ?>js/bootstrap.js"></script>  
		<!- SmartMenus jQuery plugin ->
		<script type="text/javascript" src="<?php echo $url; ?>js/jquery.smartmenus.js"></script>
		<!- SmartMenus jQuery Bootstrap Addon ->
		<script type="text/javascript" src="<?php echo $url; ?>js/jquery.smartmenus.bootstrap.js"></script>  
		<!- Product view slider ->
		<script type="text/javascript" src="<?php echo $url; ?>js/jquery.simpleGallery.js"></script>
		<script type="text/javascript" src="<?php echo $url; ?>js/jquery.simpleLens.js"></script>
		<!- slick slider ->
		<script type="text/javascript" src="<?php echo $url; ?>js/slick.js"></script>
		<!- Price picker slider ->
		<script type="text/javascript" src="<?php echo $url; ?>js/nouislider.js"></script>
		<!- Custom js ->
		<!-<script src="<?php echo $url; ?>js/custom.js"></script> -> 
        <script type="text/javascript" src="<?php echo $url; ?>js/maps/d3.v4.min.js"></script>
        <script type="text/javascript" src="<?php echo $url; ?>js/maps/leaflet.js"></script>-->
        <!-- DataTables -->
        <script src="<?php echo $url; ?>js/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $url; ?>js/datatables/dataTables.bootstrap.min.js"></script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</body>
</html>