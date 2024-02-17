<head>
<?php
session_start(); 
include_once '../classes/control.php';
require_once '../classes/user.php';
$db = new control_functions();
$user_function = new user_function();

if (!isset($_SESSION['LOGIN_USER_ID'],$_SESSION['LOGIN_USER'])) {
  header('Location: ../index.php');
  exit();
}
$login_user_id = $_SESSION['LOGIN_USER_ID'];
$login_user = $_SESSION['LOGIN_USER'];

if (isset($_POST['update_user']) && $_SESSION['FORM_SECRET'] == $_POST['API_secret']) {
  
  $calling_name = $_POST['calling_name'];
  $contact_number = $_POST['contact_number'];
  $address = $_POST['address'];


    
          $reguest_array = array(
              'calling_name' => $calling_name,
              'contact_number' => $contact_number,
              'address' => $address,
              'user_id'=>$login_user_id
          );

          $result = $user_function->updateUserDetails($reguest_array);

          if ($result) {
             $_SESSION['MSG'] = "<div class='sucees-msg' > Successfully updated your account. </div>";
          } else {
              $_SESSION['MSG'] = "<div class='error-msg' >Failed updated your account</div>";
          }
      
  
}

$querySearchAccounts = "SELECT * FROM `user` u, `user_detail` d, `role` r WHERE u.`user_id` = d.`user_id` AND u.`role_id` = r.`role_id` AND u.`user_id` ='$login_user_id'";
$resultAccounts = $db->select1DB($querySearchAccounts);
$accountName = $resultAccounts['name'];
$accountRole = $resultAccounts['role_name'];

?>
	<!-- Required meta tags -->
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="css/style.css?v=9"/>
  <!-- endinject -->
</head>