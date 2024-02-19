<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php';


if (isset($_POST['update_user_password']) && $_SESSION['FORM_SECRET'] == $_POST['API_secret']) {



  $current_password = $_POST['current_password'];
  $confirm_password = $_POST['confirm_password'];
  $new_password = $_POST['password'];

  $querytUser = "SELECT * FROM `user` WHERE `user_id` ='$login_user_id'";
  $resultUser = $db->select1DB($querytUser);

  if ($resultUser['user_password'] == $current_password) {
    if ($new_password == $confirm_password) {


      $reguest_array = array(
        'password' => $confirm_password,
        'user_id' => $login_user_id
      );

      $result = $user_function->updatePassword($reguest_array);

      if ($result) {
        $_SESSION['MSG'] = "<div class='sucees-msg' > Successfully updated your password. </div>";
      } else {
        $_SESSION['MSG'] = "<div class='error-msg' >Failed updated your password</div>";
      }
    } else {
      $_SESSION['MSG'] = "<div class='error-msg' >The Password is not match</div>";
    }
  } else {
    $_SESSION['MSG'] = "<div class='error-msg' >Current Password is incorrect</div>";
  }
}

?>


<body id="main-body">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once 'header.php'; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome <?php echo $accountName; ?></h3>
              </div>

            </div>
          </div>
        </div>



        <?php
        if (isset($_SESSION['MSG'])) {
          echo $_SESSION['MSG'];
          unset($_SESSION['MSG']);
        }
        ?>


        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">User Settings</p>
                
                <div class="row">
                  <div class="col-6">



                    <form autocomplete="off" id="user-settings-form" action="" method="post" class="form-horizontal">


                      <fieldset>



                        <div class="control-group">
                          <label class="control-label" for="calling_name">Calling Name</label>

                          <div class="controls form-group">

                            <input class="span4 form-control" id="calling_name" name="calling_name" value="<?php echo $accountName; ?>" type="text">


                          </div>
                          <!-- /controls -->
                        </div>
                        <!-- /control-group -->

                        <div class="control-group">
                          <label class="control-label" for="contact_number">Contact Number</label>

                          <div class="controls form-group">

                            <input class="span4 form-control" id="contact_number" name="contact_number" value="<?php echo $resultAccounts['mobile_number']; ?>" type="text">


                          </div>
                          <!-- /controls -->
                        </div>
                        <!-- /control-group -->

                        <div class="control-group">
                          <label class="control-label" for="contact_number">Address</label>

                          <div class="controls form-group">

                            <input class="span4 form-control" id="address" name="address" value="<?php echo $resultAccounts['address']; ?>" type="text">


                          </div>
                          <!-- /controls -->
                        </div>
                        <!-- /control-group -->


                        <div class="form-actions">
                          <input type="hidden" name="API_secret" value="<?php echo $form_secret; ?>">

                          <button type="submit" name="update_user" id="update_user" class="btn btn-primary site-btn">Update</button>
                        </div>
                        <!-- /form-actions -->



                      </fieldset>
                    </form>



                  </div>
                </div>


                <div style="margin-top: 60px;">
                  <p class="card-title">Update Password</p>
                  <div class="row">
                    <div class="col-6">



                      <form autocomplete="off" id="user-password-form" action="" method="post" class="form-horizontal">


                        <fieldset>

                          <div class="control-group">
                            <label class="control-label" for="password">Current Password</label>

                            <div class="controls form-group">

                              <input class="span4 form-control" id="current_password" name="current_password" type="password">


                            </div>
                            <!-- /controls -->
                          </div>
                          <!-- /control-group -->

                          <div class="control-group">
                            <label class="control-label" for="password">New Password</label>

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

                          <div class="form-actions">
                            <input type="hidden" name="API_secret" value="<?php echo $form_secret; ?>">

                            <button type="submit" name="update_user_password" id="update_user_password" class="btn btn-primary site-btn">Update</button>
                          </div>
                          <!-- /form-actions -->



                        </fieldset>
                      </form>



                    </div>
                  </div>
                </div>



              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php require_once 'footer.php'; ?>

    <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <script>
    $(document).ready(function() {
      $('#user-settings-form').bootstrapValidator({
        framework: 'bootstrap',

        fields: {

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
          }
        }
      });
    });



    $(document).ready(function() {
      $('#user-password-form').bootstrapValidator({
        framework: 'bootstrap',

        fields: {

          current_password: {
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

</body>
<script>
  document.getElementById('main-body').addEventListener('contextmenu', function(e) {
    e.preventDefault(); // Prevent the default context menu
  });

  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });

  document.addEventListener('keydown', function(e) {
    // Check if the user is pressing a combination of keys that opens developer tools
    if ((e.ctrlKey || e.metaKey) && (e.key === 'I' || e.key === 'i')) {
      e.preventDefault(); // Prevent the default behavior
    }
  });

  const detectDevTools = () => {
    const widthThreshold = 160;
    const heightThreshold = 160;

    if (window.outerWidth - window.innerWidth > widthThreshold || window.outerHeight - window.innerHeight > heightThreshold) {
      document.body.innerHTML = 'Page loading is disabled when DevTools are open.';
    }
  };
  setInterval(detectDevTools, 1000);


  document.addEventListener("contextmenu", function(e) {
    e.preventDefault();
  });
</script>

</html>