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


	<!-- Hero section -->
	<section class="page-info-section set-bg" data-setbg="img/home-cover.png?v=1">
		<!--<div class="container">
			<div class="hero-text text-red">
				<h2>EARN YOUR FUTURE</h2>
				<p>Knowledge is the greatest strength in the realm of technology <br> Crypto is the Key in shaping the future</p>
			</div>
			<div class="row">
				
			</div>
		</div>-->

	</section>
	<!-- Hero section end -->


	<!-- categories section -->


	</section>

	<!-- categories section end -->

	
	<!-- search section end -->

	


	<!-- course section -->


	<div class="course-warp">
		<ul class="course-filter controls">
			<li class="control active" data-filter="all">All</li>
			<?php
			$queryCat = "SELECT * FROM `course_category`";
			$execQueryCat = $db->selectDB($queryCat);

			foreach ($execQueryCat['data'] as $resultCat) {
				// echo '<option value="' . $resultVal['role_id'] . '">' . $resultVal['role_name'] . '</option>';

			?>
				<li class="control" data-filter=".cat<?php echo $resultCat['category_id']; ?>"><?php echo $resultCat['category']; ?></li>

			<?php } ?>
		</ul>
		<div class="row course-items-area">


			<?php
			$querySearch = "SELECT * FROM `course` c , `user_detail` d WHERE c.`user_id` = d.`user_id`";

			if (isset($_POST['search-course'])) {
				$querySearch = "SELECT * FROM `course` c,  `course_category` g, `user_detail` d WHERE c.`user_id` = d.`user_id` AND c.`category_id` = g.`category_id`";

				$corese_s = $_POST['corese-s'];
				$catgory_s = $_POST['catgory-s'];

				if (strlen($corese_s) > 0) {
					$querySearch .= " AND c.`course_name` LIKE '%$corese_s%'";
				}

				if (strlen($catgory_s) > 0) {
					$querySearch .= " AND g.`category` LIKE '%$catgory_s%'";
				}
			}
			$querySearch .= "  ORDER BY c.`course_order` ASC";
			$execQuerySearch = $db->selectDB($querySearch);
			//print_r($execQuerySearch['data']);
			foreach ($execQuerySearch['data'] as $resultVal) {
				// echo '<option value="' . $resultVal['role_id'] . '">' . $resultVal['role_name'] . '</option>';

				$courseID = $resultVal['course_id'];
				$queryStu = "SELECT * FROM `student_course` WHERE `course_id` ='$courseID'";
				$queryStuRes = $db->selectDB($queryStu);

				$courseStatus = $resultVal['status'];

			?>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 cat<?php echo $resultVal['category_id']; ?>">
				<?php if($courseStatus == 1){ ?>
					<a href="single-course.php?cid=<?php echo $courseID; ?>">
					<?php } ?>
						<div class="course-item">
							<div class="course-thumb set-bg" data-setbg="img/courses/<?php echo $resultVal['img']; ?>?v=2">
								<!--<div class="price">Price: USD <?php // echo $resultVal['course_fee']; ?></div>-->
							</div>
							<div class="course-info">
								<div class="course-text">
									<h5><?php echo $resultVal['course_name']; ?></h5>
									<!--<div class="students"><?php // echo $queryStuRes['rowCount'] 
																?> Students</div>-->
								</div>
								<!--<div class="course-author">
										<div class="ca-pic set-bg" data-setbg="img/authors/<?php // echo (strlen($resultVal['user_img']) > 0) ? $resultVal['user_img'] : "profile.jpeg"; 
																							?>"></div>
										<p><?php // echo $resultVal['name']; 
											?></p>
									</div>-->
							</div>
						</div>
						<?php if($courseStatus == 1){ ?>
					</a>
					<?php } ?>
				</div>
				<!-- course -->
			<?php	}
			?>

		</div>
	</div>
	</section>
	<!-- course section end -->


	<!-- signup section -->
	<section class="signup-section spad">
		<div class="signup-bg set-bg" data-setbg="img/bg8.png?v=1"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="signup-warp">
						<div class="section-title text-white text-left">
							<!-- <h2>Sign up to became a teacher</h2> -->
							
						</div>
						<!-- signup form -->
						<!--form class="signup-form"-->
						<!--input type="text" placeholder="Your Name">
							<input type="text" placeholder="Your E-mail">
							<input type="text" placeholder="Your Phone">
							<label for="v-upload" class="file-up-btn">Upload Course</label>
							<input type="file" id="v-upload"-->
						<!-- <button class="site-btn">Registor Now</button> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- signup section end -->




	<?php require_once 'footer.php'; ?>
</body>

</html>