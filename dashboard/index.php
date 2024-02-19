<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; 


if($accountRole == 'Admin'){
  header('Location: admin_index.php');
  exit();

}else if($accountRole == 'Student'){
  header('Location: student_index.php');
  exit();

}else if($accountRole == 'Lecture'){
  header('Location: lecture_index.php');
  exit();

}else{
  header('Location: logout.php');
  exit();

}

?>

  
