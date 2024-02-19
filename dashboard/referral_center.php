<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; ?>


<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php

    if (isset($_POST['withdrow_payment']) && $_SESSION['FORM_SECRET'] == $_POST['withdrow_secret']) {
      $amount = $_POST['amount'];

      $getRefCenterData = json_decode($user_function->getRefCenter($login_user_id), true);
      if ($getRefCenterData['available_balance'] >= $amount) {
        $reguest_array = array(
          'amount' => $amount, 'user_id' => $login_user_id
        );

        $result = $user_function->withdrowalReq($reguest_array);

        if ($result) {
          $_SESSION['MSG'] = "<div class='sucees-msg' >Successfully sent your withdrawal request, Will be process within 48 Hours</div>";
        } else {
          $_SESSION['MSG'] = "<div class='error-msg' >Your withdrawal request failed </div>";
        }
      } else {
        $_SESSION['MSG'] = "<div class='error-msg' >withdrawal amount not available</div>";
      }
    }
    require_once 'header.php';
    $getRefCenter = json_decode($user_function->getRefCenter($login_user_id), true);
    $withdrawReqCount = $user_function->getWithdrawReqCount($login_user_id);
    //print_r($getRefCenter['tatal_earning']);
    ?>
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



          <div class="col-md-12 grid-margin transparent">
            <div class="row">
              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-tale">
                  <div class="card-body">
                    <p class="fs-30 mb-4"><?php echo $getRefCenter['tatal_earning']; ?> $</p>
                    <p class="fs-30 mb-4">My Total Earning</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                  <div class="card-body">
                    <p class="fs-30 mb-4"><?php echo $getRefCenter['available_balance'];  ?> $</p>
                    <p class="fs-30 mb-4">Available Balance</p>

                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 mb-4"><?php echo $getRefCenter['total_withdrowal'];  ?> $</p>
                    <p class="fs-30 mb-4">Total Withdrawal</p>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-12 grid-margin transparent">
            <div class="row">
              <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-30 font-weight-medium">Direct Sales Bonus</p>
              </div>
              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 "><?php echo $getRefCenter['direct_earning'];  ?> $</p>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-30 font-weight-medium">Startup Bonus</p>
              </div>
              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 "><?php echo $getRefCenter['startaup_bonus'];  ?> $</p>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-30 font-weight-medium">Team Bonus</p>
              </div>
              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 "><?php echo $getRefCenter['team_bonus'];  ?> $</p>
                  </div>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-md-6 mb-1 grid-margin transparent">
                <div class="row">
                  <p class="text-primary fs-30 font-weight-medium">Level 3 Affiliate</p>
                </div>
                <div class="row">
                  <p class="text-primary-one fs-20 font-weight-medium line-nested">Level 3,4 & 5</p>
                </div>
                <div class="row">
                  <p class="text-primary-two fs-20 font-weight-medium line-double-nested">3 Ref Required</p>

                  <div class="col-md-2 mb-1 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="row">
                        <div class="card-body">
                          <p class="fs-30 "><?php echo $getRefCenter['l3RefCount'];  ?>/3</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 "><?php echo $getRefCenter['level345'];  ?> $</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-1 grid-margin transparent">
                <div class="row">
                  <p class="text-primary fs-30 font-weight-medium">Level 2 Affiliate</p>
                </div>
                <div class="row">
                  <p class="text-primary-one fs-20 font-weight-medium line-nested">Level 6 & 7</p>
                </div>
                <div class="row">
                  <p class="text-primary-two fs-20 font-weight-medium line-double-nested">6 Ref Required</p>

                  <div class="col-md-2 mb-1 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="row">
                        <div class="card-body">
                          <p class="fs-30 "><?php echo $getRefCenter['l6RefCount'];  ?>/6</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 "><?php echo $getRefCenter['level67'];  ?> $</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-1 grid-margin transparent">
                <div class="row">
                  <p class="text-primary fs-30 font-weight-medium">Level 1 Affiliate</p>
                </div>
                <div class="row">
                  <p class="text-primary-one fs-20 font-weight-medium line-nested">Level 8 & 9</p>
                </div>
                <div class="row">
                  <p class="text-primary-two fs-20 font-weight-medium line-double-nested">9 Ref Required</p>

                  <div class="col-md-2 mb-1 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="row">
                        <div class="card-body">
                          <p class="fs-30 "><?php echo $getRefCenter['l9RefCount'];  ?>/9</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-4 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <p class="fs-30 "><?php echo $getRefCenter['level89'];  ?> $</p>
                  </div>
                </div>
              </div>
            </div>




            <div class="row">
              <div class="col-md-6 grid-margin transparent">
                <p class="text-primary fs-20 font-weight-500">My Referral Code : </p>
                <p><?php echo $referalCode; ?> <button onclick="myFunction()">
                    Copy Ref Code</button> </p>
                <p class="text-primary fs-20 font-weight-500" style=" display: inline-block;">My Referral Link :</p>
                <p> <span id="refLink"><?php echo "https://www.3c.lk/register.php?ref=" . $referalCode; ?></span>
                </p> <button onclick="myFunction()">Copy Ref Link</button>

              </div>
              <div class="col-md-6 grid-margin transparent">

                <div class="form-actions">
                  <?php
                  // Set the default timezone to the server's timezone
                  date_default_timezone_set('UTC');

                  // Create a DateTime object for the current date and time in the server's timezone
                  $dateTime = new DateTime('now');

                  // Set the timezone to Sri Lanka
                  $dateTime->setTimezone(new DateTimeZone('Asia/Colombo'));

                  // Get the current day of the week in Sri Lanka timezone (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
                   $currentDay = $dateTime->format('w');

                  //&& $currentDay == 6
                  if ($withdrawReqCount < 1 && $currentDay == 6) { ?>
                    <button type="submit" name="login_user" id="login_user" class="btn btn-primary site-btn" data-toggle="modal" data-target="#withdrowalModal">Withdrawals</button>
                  <?php } else { ?>
                    <button type="submit" name="login_user" id="login_user" class="btn btn-primary site-btn" disabled>Withdrawals</button>

                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="withdrowalModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form autocomplete="off" id="payment-withdrow-form" action="?action=withdrow" method="post" class="form-horizontal">


                  <fieldset>



                    <div class="control-group">
                      <label class="control-label" for="binance_id">Amount</label>

                      <div class="controls form-group">

                        <input class="span4 form-control" id="amount" name="amount" value="0" type="number">


                      </div>
                      <!-- /controls -->
                    </div>


                    <div class="form-actions">
                      <input type="hidden" name="withdrow_secret" value="<?php echo $form_secret; ?>">


                      <button type="submit" name="withdrow_payment" id="withdrow_payment" class="btn btn-primary site-btn">Withdraw</button>


                    </div>
                    <!-- /form-actions -->



                  </fieldset>
                </form>
              </div>
              <div class="modal-footer">

              </div>
            </div>

          </div>
        </div>



        <!-- partial:partials/_footer.html -->
        <?php require_once 'footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


</body>

</html>