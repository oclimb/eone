<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php

//print_r($_POST);

$msg = "";
require_once 'classes/login.php';
$login_f = new login_function();

if (isset($_GET['login'])) {
    $_SESSION['MSG'] = "<div class='sucees-msg' >You successfully created your account</div>";
}

if (isset($_POST['login_user'])) {

    $username = $_POST['user_name'];
    $password = $_POST['password'];

    $result = $login_f->login($username, $password);


    if ($result) {

        header('Location: dashboard');
        exit();
    } else {
        $_SESSION['MSG'] = "<div class='error-msg' >Incorrect User Name or Password </div>";
    }
}

?>
    <!-- Header section -->
    <?php require_once 'header.php'; ?>
    
    <!-- Header section end -->


    <!-- Page info -->
    <!-- <div class="page-info-section set-bg" data-setbg="img/bg4.png?v=1">
		<div class="container">
			
		</div>
	</div> -->
    <!-- Page info end -->


    <!-- search section -->
    <!--
	
	-->
    <!-- search section end -->



    <!-- Page -->

    <section class="contact-page contact-spad pb-0">
        <div class="container">



            <div class="aboutus-section">
                <div class="container">
                    <section class="login-block">
                        <div class="login-container">
                            <div class="row ">
                                <div class="col login-sec">
                                    <h2 class="text-center">Login Now</h2>
                                    <?php
                if (isset($_SESSION['MSG'])) {
                    echo $_SESSION['MSG'];
                    unset($_SESSION['MSG']);
                }
                ?>
                                    <form method="post" id="user-login-form"  class="login-form">


                                        <fieldset>




                                            <div class="control-group">
                                                <label class="control-label" for="user_name">Email</label>

                                                <div class="controls form-group">
                                                    <input class="form-control" type="text" value="" id="user_name" name="user_name">

                                                </div>
                                                <!-- /controls -->
                                            </div>
                                            <!-- /control-group -->


                                            <div class="control-group">
                                                <label class="control-label" for="password">Password</label>

                                                <div class="controls form-group">

                                                    <input class="span4 form-control" id="password" name="password" type="password">


                                                </div>
                                                <!-- /controls -->
                                            </div>
                                            <!-- /control-group -->


                                            <div class="form-actions">


                                                <button type="submit" name="login_user" id="login_user" class="btn btn-primary site-btn">Login</button>
                                            </div>
                                            <!-- /form-actions -->
                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>




        </div>
    </section>

    <!-- Page end -->

    <script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('user-login-form').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default Enter key behavior
            document.getElementById('login_user').click(); // Simulate a click on the submit button
        }
    });
});
</script>
    <?php require_once 'footer.php'; ?>
     <!--====== Javascripts & Jquery ======-->
     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/circle-progress.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    
    <script type="text/javascript" src="js/bootstrapValidator.js?v=14"></script>
</body>

<script>

$(document).ready(function() {
    $('#user-login-form').bootstrapValidator({
				framework: 'bootstrap',
				excluded: [':disabled', '[readonly]',':hidden', ':not(:visible)'],
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					user_name: {
						validators: {
                            notEmpty: {
                                    message: 'This is a required',
                                }
						}
					},
					password: {
						validators: {
							notEmpty: {
                                    message: 'This is a required',
                                }
						}
					}
				}
			});
		});
	</script>
<?php $db->disconnect();?>
</html>