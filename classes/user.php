<?php



include_once dirname(__FILE__) . '/../classes/control.php';

//session_start();


class user_function
{



	private $db = '';



	public function __construct()
	{

		$this->db = new control_functions();
	}


	function register(array $data)
	{

		$response_validate = false;

		$email = $data['email'];
		$calling_name = $data['calling_name'];
		$contact_number = $data['contact_number'];
		$password = $data['password'];
		$user_role = $data['user_role'];
		$referral_id = $data['referral_id'];
		$address = $data['address'];

		$isfaildUser = false;
		$isfaildRefferel = false;
		$userID = '';
		$userReferral_id = '';

		// Create user account
		$instUQ = "INSERT INTO `user` (`user_name`, `user_password`, `role_id`,`reg_date`) VALUES ('$email', '$password', '$user_role',NOW())";
		$responseUser = $this->db->execDBReturnId($instUQ);
		$responseUserData = json_decode($responseUser, true);

		if ($responseUserData['status']) {
			$userID = $responseUserData['id'];

			//create referral code
			$last_referral_id = $this->db->getValueAsf("SELECT `referral_code` AS f FROM `referral` ORDER BY `referral_id` DESC LIMIT 1");
			$RefNo = explode("A", $last_referral_id)[1] + 1;
			$referral_code = 'EONE' . (strtoupper(substr(md5(time()), 0, 3))) . 'A' . $RefNo;

			//referal network and level
			//$level_id = "";

			// $resultNetwork = $this->planData($data);
			// $resultNetworkData = json_decode($resultNetwork, true);
			// $network_referral_id = $resultNetworkData['network_referral_id'];
			// $level_id = $resultNetworkData['level'];
			// $networkStatus = $resultNetworkData['status'];

			// if ($networkStatus) {
			// Create referrel account
			$instRefQ = "INSERT INTO `referral` (`referral_code`, `no_of_refferrals`, `ref_commission`, `comm_paid`, `comm_balance`, `network_comm`, `user_id`) VALUES ('$referral_code', '', '', '', '', '', '$userID')";

			$responseReferral = $this->db->execDBReturnId($instRefQ);
			$responseReferralData = json_decode($responseReferral, true);

			if ($responseUserData['status'] && $responseReferralData['status']) {
				$userReferral_id = $responseReferralData['id'];


				// Create User Details
				$instQ = "INSERT INTO `user_detail` (`name`, `user_id`, `address`, `telephone_number`, `mobile_number`, `email`, `referral_id`) 
					VALUES ('$calling_name', '$userID', '$address', '$contact_number', '$contact_number', '$email', '$referral_id')";
				$responseUserDetails = $this->db->execDB($instQ);

				if ($responseUserDetails) {
					$response_validate = true;
				} else {
					$isfaildRefferel = true;
					$isfaildUser = true;
				}
			} else {
				$isfaildUser = true;
			}
			// } else {
			// 	$isfaildUser = true;
			// }
		}

		//reverse failed records
		if (!$response_validate) {
			if ($isfaildUser) {
				$this->db->execDB("DELETE FROM `user` WHERE `user_id` = '$userID'");
			}
			if ($isfaildRefferel) {
				$this->db->execDB("DELETE FROM `referral` WHERE `referral_id` = '$userReferral_id'");
			}
		}

		$this->db->disconnect();


		return $response_validate;
	}


	function delete($user_id)
	{

		$response_validate = false;

		// Delete course
		$responseUser_detail = $this->db->execDB("DELETE FROM `user_detail` WHERE `user_id` = '$user_id'");
		$responseReferral = $this->db->execDB("DELETE FROM `referral` WHERE `user_id` = '$user_id'");
		$responseUser = $this->db->execDB("DELETE FROM `user` WHERE `user_id` = '$user_id'");

		if ($responseUser) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}


	function updatePassword(array $data)
	{

		$response_validate = false;

		$user_id = $data['user_id'];
		$password = $data['password'];

		$isfaildCourse = false;

		// update course
		$query = "UPDATE `user` SET `user_password` = '$password' WHERE `user_id`='$user_id'";
		$responseUser = $this->db->execDB("$query");

		if ($responseUser) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}

	function aceptAgree($user_id)
	{

		// update course
		$query = "UPDATE `user` SET `isagreed` = 1 WHERE `user_id`='$user_id'";
		$responseUser = $this->db->execDB("$query");

		
		$this->db->disconnect();


		return $responseUser;
	}

	function updatePament(array $data)
	{

		$response_validate = false;

		$user_id = $data['user_id'];
		$acc_no = $data['acc_no'];
		$acc_name = $data['acc_name'];
		$acc_bank = $data['acc_bank'];
		$acc_branch = $data['acc_branch'];
		$acc_branch_code = $data['acc_branch_code'];

		$isfaildCourse = false;

		// update course
		$query = "REPLACE INTO `payment_method` (`user_id`, `acc_no`, `name`, `bank`, `branch`,`branch_code`,`status`, `create_date`)
		 VALUES ('$user_id', '$acc_no', '$acc_name', '$acc_bank', '$acc_branch', '$acc_branch_code', 1, NOW())";
		$responseUser = $this->db->execDB("$query");

		

		return $responseUser;
	}


	function updateUserDetails(array $data)
	{

		$response_validate = false;

		$user_id = $data['user_id'];
		$calling_name = $data['calling_name'];
		$contact_number = $data['contact_number'];
		$address = $data['address'];

		$isfaildCourse = false;

		// update course
		$query = "UPDATE `user_detail` SET `name` = '$calling_name',`mobile_number` = '$contact_number',`telephone_number` = '$contact_number',`address` = '$address' WHERE `user_id`='$user_id'";
		$responseUser = $this->db->execDB($query);

		if ($responseUser) {
			$response_validate = true;
		}

		$this->db->disconnect();


		return $response_validate;
	}

	function sendEmailForgotPass($userName)
	{

		$query = "SELECT * FROM `user` WHERE `user_name` = '$userName'";
		$queryEx = $this->db->select1DB($query);
		$token = strtoupper(substr(md5(time()), 0, 40));

		$userID =  $queryEx['user_id'];



		$instQ = "INSERT INTO `token_password` (`token`, `user_id`, `create_date`) 
		VALUES ('$token', '$userID', NOW())";
		$responseUserDetails = $this->db->execDB($instQ);


		$link = "https://www.eonelk.lk/reset_password.php?token=" . $token;
		if (strlen($queryEx['user_name']) > 0) {
			$to = trim($userName);
			$headers = "From: info@eonelk.lk\r\n";
			$subject = 'Forgot Password';
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '
			<html>
			<head>
			  <title>{$mail->Subject}</title>
			</head>
			<body>
			  <h1>Hello, This is a test email!</h1>
			  <p><a href="' . $link . '">Forgot Password</a></p>
			</body>
			</html>
		';


			//echo $message;
			$send = @mail($to, $subject, $message, $headers);
		}
	}

	function paymentAprovel($paymentId)
	{
		$response_validate = false;

		$query = "SELECT * FROM `student_course` s,`user_detail` d WHERE s.`student_id`= d.user_id  AND s.`id` = '$paymentId'";
		$queryEx = $this->db->select1DB($query);

		$referral_id = $queryEx['referral_id'];
		$userNetwork_referral_id = $queryEx['network_referral_id'];
		$user_detail_id = $queryEx['user_detail_id'];
		$course_id = $queryEx['course_id'];
		$student_id = $queryEx['student_id'];
		$bonusNetwork_referral_id = $queryEx['network_referral_id'];


		$queryCourse = "SELECT * FROM `course` WHERE `course_id` = '$course_id'";
		$queryCourseEx = $this->db->select1DB($queryCourse);
		$courseAmmount = $queryCourseEx['course_fee'];

		$query = "UPDATE `student_course` SET `status` = 1,`approval_date` = NOW() WHERE `id`='$paymentId'";
		$responseQ = $this->db->execDB($query);

		if ($responseQ) {
			if (strlen($userNetwork_referral_id < 1)) {
				//referal network and level


				$resultNetwork = $this->planData(array('referral_id' => $referral_id));
				$resultNetworkData = json_decode($resultNetwork, true);
				$network_referral_id = $resultNetworkData['network_referral_id'];
				$level_id = $resultNetworkData['level'];
				$networkStatus = $resultNetworkData['status'];

				if ($networkStatus) {
					$query = "UPDATE `user_detail` SET `network_referral_id` = '$network_referral_id', `level_id`='$level_id',`network_date`= NOW() WHERE `user_detail_id`='$user_detail_id'";
					$responseQ = $this->db->execDB($query);
					$response_validate = true;
					$bonusNetwork_referral_id = $resultNetworkData['network_referral_id'];
				}
			} else {
				$response_validate = true;
			}
			if ($response_validate) {
				$directBonus = $this->directBonus(array('courseAmmount' => $courseAmmount, 'referral_id' => $referral_id, 'course_id' => $course_id));
				$matrixBonus = $this->matrixBonus(array('courseAmmount' => $courseAmmount, 'referral_id' => $referral_id, 'network_referral_id' => $bonusNetwork_referral_id, 'course_id' => $course_id));
			}
		}
		return $response_validate;
	}
	//start bonus functions
	function directBonus(array $data)
	{

		$courseAmmount = $data['courseAmmount'];
		$referral_id = $data['referral_id'];
		$course_id = $data['course_id'];
		//$bonusAmount = ($courseAmmount / 100) * 10;

		$bonusAmountQ = "SELECT `direct_bonus` AS f FROM `course` WHERE `course_id` = '$course_id'";
        $bonusAmount = $this->db->getValueAsf($bonusAmountQ);
		

		$sponserQ = "SELECT `user_id` AS f FROM `referral` WHERE `referral_id` = '$referral_id' ";
		$referralUser = $this->db->getValueAsf($sponserQ);

		$instQ = "INSERT INTO `student_bouns` (`bonus_ammount`, `bonus_type`, `user_id`, `course_id`, `payment_status`, `bonus_date`) 
		VALUES ('$bonusAmount', 'direct', '$referralUser', '$course_id',1, NOW())";
		$responseUserDetails = $this->db->execDB($instQ);
	}

	function matrixBonus(array $data)
	{

		$courseAmmount = $data['courseAmmount'];
		$direct_referral_id = $data['referral_id'];
		$network_referral_id = $data['network_referral_id'];
		$course_id = $data['course_id'];


		for ($i = 1; $i < 10; $i++) {
			$precentage = 1;
			if ($i == 1) {
				$precentage = 10;
			} else if ($i == 2) {
				$precentage = 8;
			} else if ($i == 3) {
				$precentage = 6;
			} else if ($i == 4) {
				$precentage = 4;
			} else if ($i == 5) {
				$precentage = 2;
			} else if ($i == 6) {
				$precentage = 2;
			} else if ($i == 7) {
				$precentage = 2;
			}
			$bonusAmountQ = "SELECT `referral_bonus` AS f FROM `course` WHERE `course_id` = '$course_id'";
			$bonusAmount = $this->db->getValueAsf($bonusAmountQ);

			//$bonusAmount = ($courseAmmount / 100) * $precentage;
			$sponserQ = "SELECT u.`network_referral_id`,u.`user_id` FROM `user_detail` u, `referral` r  WHERE u.`user_id`=r.`user_id` AND r.`referral_id` = '$network_referral_id' ";
			$sponserEx = $this->db->select1DB($sponserQ);

			$referralUser = $sponserEx['user_id'];




			$payment_status = 0;  // 0-not qulify, 1- qulify, 2-paid
			$getRefCount  = $this->getRefCount($network_referral_id);

			$bounusSumQ = "SELECT SUM(`bonus_ammount`) AS f FROM `student_bouns` WHERE `user_id` = '$referralUser'";
			$bounusSum = $this->db->getValueAsf($bounusSumQ);


			if ($i == 1 || $i == 2) {
				if ($getRefCount > 0) {  //echo "<br>a-".$getRefCount."==".$referralUser;
					$payment_status = 1;
				} else if ($bounusSum < 51) {
					$payment_status = 1; //echo "<br>b-".$getRefCount."==".$referralUser;
				}
			} else if ($i == 3 || $i == 4 || $i == 5) {
				if ($getRefCount > 2) {
					$payment_status = 1;  //echo "<br>c-".$getRefCount."==".$referralUser;
				}
			} else if ($i == 6 || $i == 7) {
				if ($getRefCount > 8) {
					$payment_status = 1; //echo "<br>d-".$getRefCount."==".$referralUser;
				}
			} else if ($i == 8 || $i == 9) {
				if ($getRefCount > 17) {
					$payment_status = 1; //echo "<br>e-".$getRefCount."==".$referralUser;
				}
			}

			$instQ = "INSERT INTO `student_bouns` (`bonus_ammount`, `bonus_type`, `user_id`, `course_id`, `payment_status`, `bonus_date`,`level`) 
		VALUES ('$bonusAmount', 'network', '$referralUser', '$course_id', '$payment_status',NOW(),'$i')";
			$responseUserDetails = $this->db->execDB($instQ);

			if (strlen($sponserEx['network_referral_id']) > 0) {
				$network_referral_id = $sponserEx['network_referral_id'];
			} else {
				break;
			}
		}
		//exit();
	}

	function getRefCount($refID)
	{
		//Get first level referal
		$firstLq = "SELECT * FROM `user_detail` WHERE `referral_id` = '$refID'";
		$firstLEx = $this->db->selectDB($firstLq);

		$refcount = 0;
		if ($firstLEx['rowCount'] > 0) {
			foreach ($firstLEx['data'] as $getrefReData) {

				$refUserId = $getrefReData['user_id'];

				$paymentq = "SELECT * FROM `student_course` WHERE `student_id` = '$refUserId' AND `status` = 1 ";
				$paymentEx = $this->db->selectDB($paymentq);
				if ($paymentEx['rowCount'] > 0) {
					$refcount++;
				}
			}
		}
		return $refcount;
	}
	//end bonus functions


	//start network plan functions
	function planData(array $data)
	{
		$netoworkRefId = "";
		$netoworkLVL = "";
		// get user ID
		$referral_id = $data['referral_id'];
		$sponserQ = "SELECT `user_id` AS f FROM `referral` WHERE `referral_id` = '$referral_id' ";
		$referralUser = $this->db->getValueAsf($sponserQ);

		//Get first level referal
		$firstLq = "SELECT r.`referral_id` FROM `user_detail` d, `referral` r WHERE d.`user_id` = r.`user_id` AND d.`network_referral_id` = '$referral_id' ORDER BY d.`network_date` ASC";
		$firstLEx = $this->db->selectDB($firstLq);

		$lv1 = array();
		foreach ($firstLEx['data'] as $firstLRe) {
			array_push($lv1, $firstLRe['referral_id']);
		}

		if (count($lv1) < 3) {
			$netoworkRefId = $referral_id;
			$netoworkLVL = 1;
		} else {
			$returnVal = $this->factorial_recursion(array('ref' => $lv1, 'lvl' => 1));
			$this->db->disconnect();
			return $returnVal;
		}
		$this->db->disconnect();
		return json_encode(array('network_referral_id' => $netoworkRefId, "level" => $netoworkLVL, 'status' => true));
	}

	function factorial_recursion(array $data)
	{
		$space1 = array();
		$space2 = array();
		$space3 = array();



		$oldRef1 = "";
		$oldRef2 = "";
		$oldeRef3 = "";

		$spaceRef1 = "";
		$spaceRef2 = "";
		$spaceRef3 = "";

		$row = 1;
		$level = $data['lvl'];

		foreach ($data['ref'] as $refID) {
			$firstLq = "SELECT r.`referral_id` FROM `user_detail` d, `referral` r WHERE d.`user_id` = r.`user_id` AND d.`network_referral_id` = '$refID' ORDER BY d.`network_date` ASC";
			$firstLEx = $this->db->selectDB($firstLq);

			if ($firstLEx['rowCount'] > 0) {
				foreach ($firstLEx['data'] as $firstLRe) {
					if ($row == 1) {

						if (!in_array($firstLRe['referral_id'], $space1)) {
							$spaceRef1 = $firstLRe['referral_id'];
							array_push($space1, $firstLRe['referral_id']);
						}
					} else if ($row == 2) {

						if (!in_array($firstLRe['referral_id'], $space2)) {
							$spaceRef2 = $firstLRe['referral_id'];
							array_push($space2, $firstLRe['referral_id']);
						}
					} else if ($row == 3) {

						if (!in_array($firstLRe['referral_id'], $space3)) {
							$spaceRef3 = $firstLRe['referral_id'];
							array_push($space3, $firstLRe['referral_id']);
						}
					}
				}
			} else {
				if ($row == 1) {
					$spaceRef1 = $refID;
				} else if ($row == 2) {
					$spaceRef2 = $refID;
				} else if ($row == 3) {
					$spaceRef3 = $refID;
				}
			}

			if ($row == 1) {
				$oldRef1 = $refID;
			} else if ($row == 2) {
				$oldRef2 = $refID;
			} else if ($row == 3) {
				$oldRef3 = $refID;
			}
			$row++;
		}

		// echo "<br><br>";
		// print_r($space1);
		// print_r($space2);
		// print_r($space3);
		$checkedSpace = json_decode($this->checkedSpace($space1, $space2, $space3), true);
		// print_r($checkedSpace);
		// echo "<br><br>";
		if ($checkedSpace['status']) {
			$netoworkRefId = "";

			if ($checkedSpace['space'] == 1) {
				$netoworkRefId = $spaceRef1;
			} else
			if ($checkedSpace['space'] == 2) {

				$netoworkRefId = $spaceRef2;
				if (strlen($netoworkRefId) < 1) {
					$netoworkRefId = $oldRef1;
				}
			} else
			if ($checkedSpace['space'] == 3) {
				$netoworkRefId = $spaceRef3;
				if (strlen($netoworkRefId) < 1) {
					$netoworkRefId = $oldRef2;
				}
			}

			return json_encode(array('network_referral_id' => $netoworkRefId, "level" => $level, 'status' => true));
		} else {

			$reSpac1 = false;
			$reSpac2 = false;
			$reSpac3 = false;
			if (count($space1) < 2 || (!(count($space2) < 2) && !(count($space3) < 2) && (count($space1) < 3))) {
				$level++;
				$spacReturn1 = $this->factorial_recursion(array('ref' => array($oldRef1), 'lvl' => $level));
				$spacReturnDe1 = json_decode($spacReturn1, true);
				$reSpac1 = $spacReturnDe1['status'];
			}

			if ($reSpac1) {
				return $spacReturn1;
			} else {

				//if($level < 10){
				if (count($space2) < 2 || (!(count($space3) < 2) && (count($space2) < 3))) {
					$level++;
					$spacReturn2 = $this->factorial_recursion(array('ref' => array($oldRef2), 'lvl' => $level));
					$spacReturnDe2 = json_decode($spacReturn2, true);
					$reSpac2 = $spacReturnDe2['status'];
				}

				if ($reSpac2) {
					return $spacReturn2;
				} else {
					if (count($space3) < 3) {
						$level++;
						$spacReturn3 = $this->factorial_recursion(array('ref' => array($oldRef3), 'lvl' => $level));
						$spacReturnDe3 = json_decode($spacReturn3, true);
						$reSpac3 = $spacReturnDe3['status'];
					}

					if ($reSpac3) {
						return $spacReturn3;
					} else { //echo "<br>==================<br>"; print_r($refArray); echo "<br>==================<br>"; 
						$level++;

						$refArray = array(
							$oldRef1 => $space1,
							$oldRef2 => $space2,
							$oldRef3 => $space3
						);

						return  $this->factorial_recursion_multiple(array('ref' => $refArray, 'lvl' => $level));


						// return json_encode(array('network_referral_id' => '', "level" => $level, 'status' => false));
					}
				}

				// }else{
				// 	return json_encode(array('network_referral_id' => '', "level" => $level,'status'=>false));
				// }

			}
		}
	}

	function factorial_recursion_multiple(array $data)
	{
		$level = $data['lvl'];
		// print_r($data); 
		// echo "<br><br>";
		$sortArray = [];
		foreach ($data['ref'] as $refID => $subArray) {

			// $headCountQ = "SELECT r.`referral_id` FROM `user_detail` d, `referral` r WHERE d.`user_id` = r.`user_id` AND d.`network_referral_id` = '$refID'";
			// $headCountEx = $this->db->selectDB($headCountQ);
			// $headCount = $headCountEx['rowCount'];

			$headCount = $this->getHeadCount($refID);

			if (!array_key_exists($headCount, $sortArray)) {
				$sortArray[$headCount] = $subArray;
			}
		}

		// print_r($sortArray);
		//  exit();
		ksort($sortArray);

		//$firstKey = key($sortArray);
		$firstVal = reset($sortArray); //get first value
		//print_r($firstVal);
		return $this->factorial_recursion(array('ref' => $firstVal, 'lvl' => $level));
	}

	function getHeadCount($refID)
	{
		$getrefQ = "SELECT r.`referral_id` FROM `user_detail` d, `referral` r WHERE d.`user_id` = r.`user_id` AND d.`network_referral_id` = '$refID' ORDER BY d.`network_date` ASC";
		$getrefEx = $this->db->selectDB($getrefQ);
		$noOfhead = $getrefEx['rowCount'];
		$refArray = array();
		if ($noOfhead < 3) {
			//return $noOfhead;
		} else {
			foreach ($getrefEx['data'] as $getrefRe) {

				array_push($refArray, $getrefRe['referral_id']);
			}

			$noOfhead = $noOfhead + $this->headerCounter($refArray);
		}

		return $noOfhead;
	}
	function headerCounter(array $data)
	{
		//print_r($data);
		// foreach ($data as $refID1) {
		// 	echo $refID1 . "\n";
		// }
		$retHead = 0;
		foreach ($data as $refID1) { //echo "<br>".$refID1;
			$getrefQ1 = "SELECT r.`referral_id` FROM `user_detail` d, `referral` r WHERE d.`user_id` = r.`user_id` AND d.`network_referral_id` = '$refID1' ORDER BY d.`network_date` ASC";
			$getrefEx1 = $this->db->selectDB($getrefQ1);
			$noOfhead1 = $getrefEx1['rowCount'];
			$refArrayCo = array();
			if ($noOfhead1 < 3) {  //echo "<br>---".$refID1;
				//return $noOfhead1;
			} else {
				foreach ($getrefEx1['data'] as $getrefRe) { //echo "<br>-<<>>-".$refID1;
					array_push($refArrayCo, $getrefRe['referral_id']);
				}
				$noOfhead1 = $noOfhead1 + $this->headerCounter($refArrayCo);

				//return $noOfhead;
			}
			$retHead = $retHead + $noOfhead1;
		}
		return $retHead;
	}

	function checkedSpace(array $space1, array $space2, array $space3)
	{
		// print_r($space1);print_r($space2);print_r($space3);
		$status = true;
		$space = 0;
		for ($i = 0; $i < 3; $i++) {

			if (isset($space1[$i])) {

				if (isset($space2[$i])) {
					if (isset($space3[$i])) {
						$status = false;
					} else {
						$space = 3;
						break;
					}
				} else {
					$space = 2;
					break;
				}
			} else {
				$space = 1;
				break;
			}
		}

		return json_encode(array('status' => $status, 'space' => $space));
	}
	//end network plan functions

	function getAdminNetwork()
	{
		$getrefQ = "SELECT d.`name` AS reg_name,n.`name` AS newtork_name FROM `user_detail` d , `referral` r , `user_detail` n WHERE 
		d.`network_referral_id` = r.`referral_id` AND r.`user_id` = n.`user_id` AND
		d.`network_referral_id` IS NOT NULL ORDER BY d.`network_date` ASC ";

		$getrefEx = $this->db->selectDB($getrefQ);
		$noOfhead = $getrefEx['rowCount'];
		$networkArray = array();

		foreach ($getrefEx['data'] as $getrefRe) {
			$networkData = array();
			$networkData[] = $getrefRe['newtork_name'];
			$networkData[] = $getrefRe['reg_name'];
			array_push($networkArray, $networkData);
		}

		return json_encode($networkArray);
	}

	function getRefCenter($userId)
	{
		  $directCommissionQ = "SELECT SUM(`bonus_ammount`) AS f FROM `student_bouns` WHERE `user_id` = '$userId' AND `bonus_type`='direct' AND `payment_status` = 1";
          $directCommission = $this->db->getValueAsf($directCommissionQ);

          $networkCommissionQ = "SELECT SUM(`bonus_ammount`) AS f FROM `student_bouns` WHERE `user_id` = '$userId' AND `bonus_type`='network' AND `payment_status` = 1";
          $networkCommission = $this->db->getValueAsf($networkCommissionQ);

		  $totalEarning =  $directCommission + $networkCommission;


		  $totalWithdrowalQ = "SELECT SUM(`amount`) AS f  FROM `payment_withdrawal` WHERE `status` = 1 AND user_id='$userId'";
          $totalWithdrowal = $this->db->getValueAsf($totalWithdrowalQ);

		  $availableBalance = $totalEarning - $totalWithdrowal;


		  $startaupBonusQ = "SELECT SUM(`bonus_ammount`) AS f  FROM `student_bouns` WHERE `payment_status` = 1 AND `level` IN (1,2) AND user_id='$userId'";
          $startaupBonus = $this->db->getValueAsf($startaupBonusQ);

		  $teamBonusQ = "SELECT SUM(`bonus_ammount`) AS f  FROM `student_bouns` WHERE `payment_status` = 1 AND  user_id='$userId'";
          $teamBonus = $this->db->getValueAsf($teamBonusQ);


		  $level345Q = "SELECT SUM(`bonus_ammount`) AS f  FROM `student_bouns` WHERE `payment_status` = 1 AND `level` IN (3,4,5) AND user_id='$userId'";
          $level345 = $this->db->getValueAsf($level345Q);

		  $level67Q = "SELECT SUM(`bonus_ammount`) AS f  FROM `student_bouns` WHERE `payment_status` = 1 AND `level` IN (6,7) AND user_id='$userId'";
          $level67 = $this->db->getValueAsf($level67Q);

		  $level89Q = "SELECT SUM(`bonus_ammount`) AS f  FROM `student_bouns` WHERE `payment_status` = 1 AND `level` IN (8,9) AND user_id='$userId'";
          $level89 = $this->db->getValueAsf($level89Q);

		  $referIdQ = "SELECT `referral_id` AS f FROM `referral` WHERE `user_id` = '$userId'";
          $referId = $this->db->getValueAsf($referIdQ);

		  $referCountQ = "SELECT COUNT(`user_detail_id`) AS f FROM `user_detail` WHERE `referral_id` = '$referId' AND `network_referral_id` IS NOT NULL";
          $referCount = $this->db->getValueAsf($referCountQ);

		  $l3RefCount = 0;
		  $l6RefCount = 0;
		  $l9RefCount = 0;

		  if($referCount > 3){
			$l3RefCount = 3;
			$referCount = $referCount - 3;
			if($referCount > 6){
				$l6RefCount = 6;
				$referCount = $referCount - 6;
				if($referCount > 9){
					$l9RefCount = 9;
				}else{
					$l9RefCount = $referCount;
				}

			}else{
				$l6RefCount = $referCount;
			}

		  }else{
			$l3RefCount = $referCount;
		  }
		  $level345 = (strlen($level345) > 0)?$level345:0;
		  $level67 = (strlen($level67) > 0)?$level67:0;
		  $level89 = (strlen($level89) > 0)?$level89:0;
		  
		  return json_encode(array('tatal_earning'=>$totalEarning,
		  'direct_earning'=>$directCommission,
		  'total_withdrowal'=>$totalWithdrowal,
		  'available_balance'=>$availableBalance,
		  'startaup_bonus'=>$startaupBonus,
		  'team_bonus'=>$teamBonus,
		  'level345'=>$level345,
		  'level67'=>$level67,
		  'level89'=>$level89,
		  'l3RefCount'=>$l3RefCount,
		  'l6RefCount'=>$l6RefCount,
		  'l9RefCount'=>$l9RefCount,
									));

	}

	function withdrowalReq($data)
	{
		$user_id=$data['user_id'];
		$amount=$data['amount'];
		$instQ = "INSERT INTO `payment_withdrawal` (`user_id`, `amount`, `status`, `create_date`) VALUES ($user_id,$amount, 0, NOW())";
		return $this->db->execDB($instQ);
	}

	function withdrowalAcept($id)
	{
		$instQ = "UPDATE `payment_withdrawal` SET `status` = 1 , `approval_date` = NOW()  WHERE `Withdrawal_id` = '$id'";
		return $this->db->execDB($instQ);
	}

	function getWithdrawReqCount($userId)
	{
		$getrefQ = "SELECT * FROM `payment_withdrawal` WHERE `user_id` = '$userId' AND `status` = 0";
		$getrefEx = $this->db->selectDB($getrefQ);
		
		return $getrefEx['rowCount'];
	}
}
