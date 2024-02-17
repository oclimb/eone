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
$msg =""; 
if(isset($_POST['send'])){ 
$to ="rathne1982@gmail.com";


$send_name = $_POST['send_name'];
$send_email = $_POST['send_email'];
$subject = $_POST['send_subject'];
$send_msg = $_POST['send_msg'];

$headers = "From: support@3c.lk\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = 'Name-'.$send_name.'<br>'.
'E-mail-'.$send_email.'<br>'.
'Message-'.$send_msg.'<br>';


//echo $message;
$send=@mail($to, $subject, $message, $headers);
//@mail($to_ba, $subject, $message, $headers);

if($send){
	$msg = '<p style="colour=green;">Email send successful. Email: '.$to.'</p>';
}
}

?>
	<!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="img/contact-us1.jpg">
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
			<div class="row">
				<div class="col-lg-8">
					<div class="contact-form-warp">
						<div class="section-title text-white text-left">
							<h2>Get in Touch</h2>
							<p>Any inquiry... Drop Your Message... We will get back to you... </p>
						</div>
						
						<form class="contact-form" action="" method="post">
						<?php echo $msg; ?>
							<input type="text" name="send_name" placeholder="Your Name">
							<input type="text" name="send_email" placeholder="Your E-mail">
							<input type="text" name="send_subject" placeholder="Subject">
							<textarea placeholder="Message" name="send_msg"></textarea>
							<button class="site-btn" name="send">Send Message</button>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-info-area">
						<div class="section-title text-left p-0">
							<h2>Contact Info</h2>
							<p></p>
						</div>
						<div class="phone-number">
							<span>Direct Line</span>
							<h2>+94 720 230 230</h2>
						</div>
						<ul class="contact-list">
							<li>278/6,  <br>Devananda Road, Piliyandala</li>
							<li>+94 720 230 230</li>
							<li>info@3c.lk</li>
						</ul>
						<div class="social-links">
							<a href="#"><i class="fa fa-pinterest"></i></a>
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
							<a href="#"><i class="fa fa-linkedin"></i></a>
						</div>
					</div>
				</div>
			</div>
			<!--<div id="map-canvas"></div> -->
		</div>
	</section>

	<!-- Page end -->

	<?php require_once 'footer.php'; ?>
</body>
</html>