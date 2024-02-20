<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<?php require_once 'header.php'; ?>
	<!-- Header section end -->

	<?php
	$msg = "";
	if (isset($_POST['send'])) {
		// $to = "rathne1982@gmail.com";


		// $send_name = $_POST['send_name'];
		// $send_email = $_POST['send_email'];
		// $subject = $_POST['send_subject'];
		// $send_msg = $_POST['send_msg'];

		// $headers = "From: info@eonelk.lk\r\n";

		// $headers .= "MIME-Version: 1.0\r\n";
		// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		// $message = 'Name-' . $send_name . '<br>' .
		// 	'E-mail-' . $send_email . '<br>' .
		// 	'Message-' . $send_msg . '<br>';


		// //echo $message;
		// $send = @mail($to, $subject, $message, $headers);
		

		// if ($send) {
		// 	$msg = '<p style="colour=green;">Email send successful. Email: ' . $to . '</p>';
		// }
	}

	?>
	<!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="img/contact-us.png?v=1">
		<div class="container">

		</div>
	</div>
	<!-- Page info end -->


	<!-- search section -->
	<!--
	<section class="search-section ss-other-page">
		<div class="container">
			<div class="search-warp">
				<div class="section-title text-white">
					<h2><span>Search your course</span></h2>
				</div>
				<div class="row">
					<div class="col-lg-10 offset-lg-1"> -->
	<!-- search form -->
	<!--
						<form class="course-search-form">
							<input type="text" placeholder="Course">
							<input type="text" class="last-m" placeholder="Category">
							<button class="site-btn btn-dark">Search Couse</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	-->
	<!-- search section end -->



	<!-- Page -->

	<section class="contact-page contact-spad pb-0">
		<div class="container">
			<div class="thm-container">
				<div class="row">
					<div class="col-md-8">
						<div class="contact-form-content">
							<div class="title">
								<span>Contact with us</span>
								<h2>Send Message</h2>
							</div><!-- /.title -->
							<form method="post" id="user-contact-form" class="contact-form">


								<fieldset>




									<div class="control-group">
										<label class="control-label" for="user_name">name</label>

										<div class="controls form-group">
											<input class="form-control" type="text" value="" id="user_name" name="user_name"  placeholder="Your full name">

										</div>
										<!-- /controls -->
									</div>
									<!-- /control-group -->

									<div class="control-group">
										<label class="control-label" for="user_email">Email</label>

										<div class="controls form-group">
											<input class="form-control" type="text" value="" id="user_email" name="user_email" placeholder="Your email address">

										</div>
										<!-- /controls -->
									</div>
									<!-- /control-group -->
									
									<div class="control-group">
										<label class="control-label" for="user_msg">Message</label>

										<div class="controls form-group">
											<input class="form-control" type="text" value="" id="user_msg" name="user_msg" placeholder="What you are looking for?">

										</div>
										<!-- /controls -->
									</div>
									<!-- /control-group -->

									<div class="form-actions">


										<button type="submit" name="submit_user" id="submit_user" class="btn btn-primary site-btn">Submit Now</button>
									</div>
									<!-- /form-actions -->
								</fieldset>

							</form>
						</div><!-- /.contact-form-content -->
					</div><!-- /.col-md-8 -->
					<div class="col-md-4">
						<div class="contact-info text-center">
							<div class="title text-center">
								<span>Contact info</span>
								<h2>Details</h2>
							</div><!-- /.title -->
							<div class="single-contact-info">
								<h4>Address</h4>
								<!-- <p>88 New Street, Washington DC <br> United States, America</p> -->
							</div><!-- /.single-contact-info -->
							<div class="single-contact-info">
								<h4>Phone</h4>
								<!-- <p>Local: 222 999 888 <br> Mobile: 000 0000 0000</p> -->
							</div><!-- /.single-contact-info -->
							<div class="single-contact-info">
								<h4>Email</h4>
								<!-- <p>needhelp@printify.com <br> inquiry@printify.com</p> -->
							</div><!-- /.single-contact-info -->
							<div class="single-contact-info">
								<h4>Follow</h4>
								<div class="social">
									<a href="#" class="fab fa-twitter hvr-pulse"></a><!--  
                             --><a href="#" class="fab fa-pinterest hvr-pulse"></a><!--  
                             --><a href="#" class="fab fa-facebook-f hvr-pulse"></a><!--  
                             --><a href="#" class="fab fa-youtube hvr-pulse"></a>
								</div><!-- /.social -->
							</div><!-- /.single-contact-info -->
						</div><!-- /.contact-info -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div>
			<!--<div id="map-canvas"></div> -->
		</div>
	</section>

	<!-- Page end -->

	<?php require_once 'footer.php'; ?>
</body>

</html>