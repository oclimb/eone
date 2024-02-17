<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php
require_once 'head.php';
require_once 'classes/user.php';
$login_f = new user_function();

$dispaly = "";
$refCode ="";
if (isset($_GET['ref'])) {
    $refCode =$_GET['ref'];
}
if (isset($_GET['methodreg'])) {
    // $dispaly = "style=\"display: none;\"";
    // if($_GET['methodreg'] == 'notref'){
    //     $refCode ="CCC-353-3007";
    // }

    // if($_GET['methodreg'] == 'com'){
    //     $refCode ="CCC-F55-3075";
    // }
    //$refCode =$_GET['ref'];
}

if (isset($_POST['register']) && $_SESSION['FORM_SECRET'] == $_POST['API_secret']) {
    $email = $_POST['email'];
    $calling_name = $_POST['calling_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_role = 2;
    $referral_code = $_POST['referral_code'];

    $referral_id = $db->getValueAsf("SELECT `referral_id` AS f FROM `referral` WHERE `referral_code` = '$referral_code'");

    if (strlen($referral_id) > 0) {
        if ($password == $confirm_password) {
            $reguest_array = array(
                'email' => $email,
                'calling_name' => $calling_name,
                'contact_number' => $contact_number,
                'address' => $address,
                'password' => $confirm_password,
                'referral_id' => $referral_id,
                'user_role' => $user_role
            );

            $result = $login_f->register($reguest_array);

            if ($result) {
                header('Location: login.php?login=success');
      exit();
                //$_SESSION['MSG'] = "<div class='sucees-msg' >You successfully created your account. Continue to Login</div>";
            } else {
                $_SESSION['MSG'] = "<div class='error-msg' >You failed  create your account</div>";
            }
        } else {
            $_SESSION['MSG'] = "<div class='error-msg' >Password do not match</div>";
        }
    } else {
        $_SESSION['MSG'] = "<div class='error-msg' >Invalid referral code</div>";
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
                                    <h2 class="text-center">Register Now</h2>

                                    <?php
                if (isset($_SESSION['MSG'])) {
                    echo $_SESSION['MSG'];
                    unset($_SESSION['MSG']);
                }
                ?>
                                    <form id="reg_profile" action="" method="post"  class="login-form">


                                        <fieldset>




                                        <div class="control-group">
                            <label class="control-label" for="email">Email</label>

                            <div class="controls form-group">
                                <input class="span4 form-control" type="text" value="" id="email" name="email">

                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->


                        <div class="control-group">
                            <label class="control-label" for="calling_name">Calling Name</label>

                            <div class="controls form-group">

                                <input class="span4 form-control" id="calling_name" name="calling_name" type="text">


                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->

                        <div class="control-group">
                            <label class="control-label" for="contact_number">Contact Number</label>

                            <div class="controls form-group">

                                <input class="span4 form-control" id="contact_number" name="contact_number" type="text">


                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->

                        <div class="control-group">
                            <label class="control-label" for="contact_number">Address</label>

                            <div class="controls form-group">

                                <input class="span4 form-control" id="address" name="address" type="text">


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

                        <div class="control-group">
                            <label class="control-label" for="confirm_password">Confirm Password</label>

                            <div class="controls form-group">

                                <input class="span4 form-control" id="confirm_password" name="confirm_password" type="password">


                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->


                        <div class="control-group">
                            <label class="control-label" for="confirm_password">Register Method</label>

                            <div class="controls form-group">

                            <select class="span4 form-control" id="reg_method" name="reg_method">
                                <option value="withref">Register With Referal Code</option>
								<option value="notref">Register Without Referal Code</option>
								<!-- <option value="com">Register as VOICE-D Customer</option> -->
								
							</select>

                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->

                        

                        <div class="control-group" <?php echo $dispaly; ?> id="regDiv">
                            <label class="control-label" for="referral_code">Referral Code</label>

                            <div class="controls form-group">

                                <input class="span4 form-control" id="referral_code" name="referral_code" type="text" value="<?php echo $refCode; ?>">


                            </div>
                            <!-- /controls -->
                        </div>
                        <!-- /control-group -->
                        <br>

                        <div class="form-actions">
                            <input type="hidden" name="API_secret" value="<?php echo $form_secret; ?>">

                            <button type="submit" name="register" id="register" class="btn btn-primary site-btn">Register</button>
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
  // Attach change event handler to the select tag
  $('#reg_method').on('change', function() {
    // Get the selected value from the select tag
    var selectedMethod = $(this).val();

    var selectedRef ='';
    if(selectedMethod == 'notref'){
        selectedRef = 'EONE100A1000';
        $('#regDiv').css('display', 'none');
    }
    // if(selectedMethod == 'com'){
    //     selectedRef = 'CCC-F55-3075';
    //     $('#regDiv').css('display', 'none');
    // }

    if(selectedMethod == 'withref'){
        $('#regDiv').css('display', 'block');
    }

    // Update the value of the input tag with the selected value
    $('#referral_code').val(selectedRef);
  });
});
    $(document).ready(function() {
        $('#reg_profile').bootstrapValidator({
            framework: 'bootstrap',

            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'This is a required',
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Invalid email address'
                        }
                    }
                },
                calling_name: {
                    validators: {
                        notEmpty: {
                            message: 'This is a required',
                        }
                    }
                },
                contact_number: {
                    validators: {
                        notEmpty: {
                            message: 'This is a required',
                        },
                        regexp: {
                            regexp: '^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$',
                            message: 'Invalid Contact Number'
                        }
                    }
                },
                user_role: {
                    validators: {
                        notEmpty: {
                            message: 'This is a required',
                        }
                    }
                },
                referral_code: {
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
                },
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: 'This is a required',
                        },
                        identical: {
                            field: 'password',
                            message: '<p>The Password is not match.</p>'
                        }
                    }
                }
            }
        });
    });
</script>
<?php $db->disconnect();?>
</html>