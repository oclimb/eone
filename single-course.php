<!DOCTYPE html>
<html lang="en">
<?php
require_once 'head.php';

require_once 'classes/course.php';
$course_function = new course_function();

?>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->

	<?php
	$student_id = '';
	$courseId = $_GET['cid'];
	if (isset($_SESSION['LOGIN_USER_ID'], $_SESSION['LOGIN_USER'])) {
		$student_id = $_SESSION['LOGIN_USER_ID'];
	}


	if (isset($_GET['cid']) && (isset($_GET['action']) && $_GET['action'] == 'pay') && $_SESSION['FORM_SECRET'] == $_GET['token'] && isset($_SESSION['LOGIN_USER_ID'], $_SESSION['LOGIN_USER'])) {

		$firstLq = "SELECT * FROM `student_course` WHERE `student_id`='$student_id' AND `course_id`='$courseId' AND `status` IN (0,1)";
		$firstLEx = $db->selectDB($firstLq);
		if ($firstLEx['rowCount'] < 1) {


			$result = $course_function->paidCourse(array('course_id' => $courseId, 'user_id' => $student_id, 'payment_type' => 'bank'));


			if ($result) {
				$_SESSION['MSG'] = "<div class='sucees-msg' >Thank you. Your payment will be authorized within 24 hours.</div>";
			} else {
				$_SESSION['MSG'] = "<div class='error-msg' >Sorry. Your payment Failed. </div>";
			}
		} else {
			$_SESSION['MSG'] = "<div class='error-msg' >Your payment Already requested. </div>";
		}
	}

	?>

	<?php
	require_once 'header.php'; ?>
	<!-- Header section end -->
	<?php



	$cid = $_GET['cid'];
	$querySearch = "SELECT * FROM `course` c , `content` t, `user_detail` d, `course_category` g WHERE c.`course_id` = t.`course_id` AND c.`user_id` = d.`user_id`
			AND c.`category_id` = g.`category_id` AND c.`course_id` = '$cid'";
	$resultVal = $db->select1DB($querySearch);

	//$courseID = $resultVal['course_id'];
	$queryStu = "SELECT * FROM `student_course` WHERE `course_id` ='$cid'";
	$queryStuRes = $db->selectDB($queryStu);

	?>

	<!-- Page info -->
	<div class="page-info-section set-bg" data-setbg="img/bg4.png?v=1">

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

	<!-- single course section -->
	<section class="single-course spad pb-0" style="padding-top: 0;">
		<div class="container">
			<div class="course-meta-area">
				<div class="row">

					<div class="col-lg-10 offset-lg-1">
						<?php
						if (isset($_SESSION['MSG'])) {
							echo $_SESSION['MSG'] . "<br>";
							unset($_SESSION['MSG']);
						}
						?>
						<!-- <div class="course-note">Featured Course</div> -->
						<h3><?php echo $resultVal['course_name']; ?></h3>
						<div class="course-metas">
							<!-- <div class="course-meta">
								
							</div>
							<div class="course-meta">
								<div class="cm-info">
									<h6>Category</h6>
									<p><?php //echo $resultVal['category']; 
										?></p>
								</div>
							</div>
							<div class="course-meta">
								<div class="cm-info">
									<h6>Students</h6>
									<p><?php //echo $queryStuRes['rowCount'] 
										?> Registered Student/s</p>
								</div>
							</div>
							<div class="course-meta">
								<div class="cm-info">
									<h6>Reviews</h6>
									<?php
									// $queryRew = "SELECT CAST(SUM(`review`)/COUNT(`review`) AS INT) AS `re_percentage` , COUNT(`review`) AS `re_count` FROM `reviews` WHERE `course_id` ='$cid'";
									// $queryRewRes = $db->select1DB($queryRew);


									// $re_percentage = 5;
									// $re_count = 5;


									?>
									<p><?php //echo $re_count; 
										?> Reviews <span class="rating">

											<?php
											// for ($i = 0; $i < 5; $i++) {
											// 	if ($i < $re_percentage) {
											// 		echo '<i class="fa fa-star"></i>';
											// 	} else {
											// 		echo '<i class="fa fa-star is-fade"></i>';
											// 	}
											// }
											?>

										</span></p>
								</div>
							</div> -->
						</div>
						<a href="#" class="site-btn price-btn">Price: <?php echo $resultVal['course_fee_display']; ?></a>
						<a href="#" class="site-btn buy-btn" data-toggle="modal" data-target="#myPaymentModal">Buy This Course</a>
					</div>
				</div>
			</div>
			<img src="img/courses/<?php echo $resultVal['img']; ?> " alt="" class="course-preview" style="width: 100%;">
			<!--<div class="row">
				<div class="col-lg-10 offset-lg-1 course-list">
				<?php // echo $resultVal['course_des']; 
				?>
				</div>
			</div>-->
			<?php

			//   $queryCoursesVideo = "SELECT * FROM `content` WHERE `course_id` = '$cid' ORDER BY `order` ASC limit 1";
			//   $execQueryCoursesVideo = $db->selectDB($queryCoursesVideo);

			//   foreach ($execQueryCoursesVideo['data'] as $resultCoursesVideo) {
			?>
			<!-- <br><br>
                <h4 class="font-weight-bold"><?php //echo $resultCoursesVideo['video_name']; 
												?></h4>
                <div class="card-people mt-auto">
                  <video width="100%" controls controlsList="nodownload">
                    <source src="dashboard/videos/<?php //echo $resultCoursesVideo['file_path']; 
													?>" type="video/mp4">

                  </video>
                  <div class="weather-info">
                    <div class="d-flex">

                    </div>
                  </div>
                </div> -->
			<?php //} 
			?>
		</div>
	</section>
	<!-- single course section end -->

	<!-- The Modal -->
	<div class="modal" id="myPaymentModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Online Banking</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">Please make to a fund transfer to the following account.</div>

				<div class="modal-body"> (Use your contact number as the reference)</div>

				<div class="modal-body">Bank Name : Sampath Bank PLC - Sri Lanka</div>

				<div class="modal-body">Account Name :3C Academy</div>

				<div class="modal-body">Account Number :0019 1001 9275</div>

				<div class="modal-body">Bank Code :7278</div>

				<div class="modal-body">Branch Code :019</div>

				<div class="modal-body">SWIFT Code :BSAMLKLX</div>

				<div class="modal-body">Note: Please send the confirmation (deposit slip or online payment confirmation) to the email info@3c.lk The course will be eligible to you within 24 hours of payment</div>
				<?php
				if (!isset($_SESSION['LOGIN_USER_ID'], $_SESSION['LOGIN_USER'])) {
					echo '<div class="modal-body" style="color: red;">Only registered users can purchase courses</div>';
				}
				?>
				<!-- Modal footer -->
				<div class="modal-footer">
					<?php
					if (isset($_SESSION['LOGIN_USER_ID'], $_SESSION['LOGIN_USER'])) {

						$firstLq1 = "SELECT * FROM `student_course` WHERE `student_id`='$student_id' AND `course_id`='$courseId' AND `status` IN (0,1)";
						$firstLEx1 = $db->selectDB($firstLq1);


						if ($firstLEx1['rowCount'] < 1) {
							echo '<a href="single-course.php?cid=' . $cid . '&action=pay&token=' . $_SESSION['FORM_SECRET'] . '"  class="btn btn-danger">Paid </a>';
						}
					}
					?>

					<!-- <button type="button" class="btn btn-danger">Paid</button> -->
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<!-- Page end -->


	<?php require_once 'footer.php'; ?>
</body>

</html>