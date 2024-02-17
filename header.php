<header class="header-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="site-logo">
						<img src="img/main-logo.png?v=1" alt="">
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<!--<a href="login.php" class="site-btn header-btn d-block">Login</a>-->
					<nav class="main-menu">
					<!--<nav class="main-menu" style="display:block;">-->
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About us</a></li>
							<li><a href="courses.php">Courses</a></li>
							<!-- <li><a href="https://www.youtube.com/@ceyloncryptocircle" target="_blank">Our Youtube</a></li> -->
							<li><a href="contact.php">Contact Us</a></li>
							<li class="login-menu">
							<?php 
							if (isset($_SESSION['LOGIN_USER_ID'],$_SESSION['LOGIN_USER'])) {
								echo '<a href="ccc-admin" >Dashboard</a>';
								
							  }else{
								echo '<a href="login.php" >Login</a>';
							  }
							?>
							</li>
							<!-- <li><a href="ccc-admin">Home</a></li>			
					        <a href="login.php" class="site-btn header-btn d-block">Login</a> -->
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>

	<?php
	$form_secret = md5(uniqid(rand(), true));
	$_SESSION['FORM_SECRET'] = $form_secret;
	?>
