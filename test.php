<!DOCTYPE html>
<html lang="en">
<?php
require_once 'head.php';
require_once 'classes/user.php';
$login_f = new user_function();


$data=array('referral_id'=>1);

$resultNetwork = $login_f->planData($data);

$resultNetworkData = json_decode($resultNetwork,true);
$network_referral_id = $resultNetworkData['network_referral_id'];
$level_id = $resultNetworkData['level'];
print_r($resultNetworkData);

$form_secret = md5(uniqid(rand(), true));
$_SESSION['FORM_SECRET'] = $form_secret;
?>

<?php $db->disconnect();?>
</html>