<?php



include_once 'classes/control.php';

//session_start();


class course_function
{



	private $db = '';



	public function __construct()
	{

		$this->db = new control_functions();
	}


	function register(array $data)
	{

		$response_validate = false;

		$course_name = $data['course_name'];
		$course_des = $data['course_des'];
		$course_img = $data['course_img'];
		$course_fee = $data['course_fee'];
		$category_id = $data['category_id'];
		$user_id = $data['user_id'];

		$isfaildCourse = false;

		// Create course
		$responseCourse = $this->db->execDB("INSERT INTO `course` (`course_name`, `course_des`, `course_img`,`course_fee`,`category_id`,`user_id`) 
		VALUES ('$course_name', '$course_des', '$course_img','$course_fee','$category_id','$user_id')");
		
		if ($responseCourse) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}


	function delete($course_id)
	{

		$response_validate = false;

		// Delete course
		$responseCourseContent = $this->db->execDB("DELETE FROM `course_content` WHERE `course_id` = '$course_id'");
		$responseContent = $this->db->execDB("DELETE FROM `content` WHERE `course_id` = '$course_id'");
		$responseCourse = $this->db->execDB("DELETE FROM `course` WHERE `course_id` = '$course_id'");

		if ($responseCourse) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}

	function update(array $data)
	{

		$response_validate = false;

		$course_id = $data['course_id'];
		$course_name = $data['course_name'];
		$course_des = $data['course_des'];
		$course_img = $data['course_img'];
		$course_fee = $data['course_fee'];
		$category_id = $data['category_id'];

		$isfaildCourse = false;

		// update course
		$query = "UPDATE `course`
		SET `course_name` = '$course_name', `course_des` = '$course_des', `course_img`='$course_img',`course_fee`='$course_fee',`category_id`='$category_id'
		WHERE `course_id`='$course_id'";
		$responseCourse = $this->db->execDB("$query");
		
		if ($responseCourse) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}


	function paidCourse(array $data)
	{

		$response_validate = false;

		$course_id = $data['course_id'];
		$user_id = $data['user_id'];
		$payment_type = $data['payment_type'];
		$isfaildCourse = false;

		// Create course
		 $query = "INSERT INTO `student_course` (`student_id`, `course_id`, `enrol_date`,`payment_type`) 
		VALUES ('$user_id', '$course_id',NOW(),'$payment_type')";
		
		$responseCourse = $this->db->execDB($query);
		
		if ($responseCourse) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}
}
