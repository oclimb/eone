<!DOCTYPE html>
<html lang="en">

<?php require_once 'head.php'; 



if (isset($_GET['stid']) && $_SESSION['FORM_SECRET'] == $_GET['token'] ) {

  


    $result = $user_function->withdrowalAcept($_GET['stid']);


    if ($result) {
      $_SESSION['MSG'] = "<div class='sucees-msg' >Successfully approved payment</div>";
    } else {
      $_SESSION['MSG'] = "<div class='error-msg' >Failed approve payment </div>";
    }
  
}

?>

  
<body>
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
                <?php
						if (isset($_SESSION['MSG'])) {
							echo $_SESSION['MSG'] . "<br>";
							unset($_SESSION['MSG']);
						}
						?>

                  <h3 class="font-weight-bold">Welcome <?php echo $accountName; ?></h3>                  
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <!--<i class="mdi mdi-calendar"></i> Today (10 Jan 2021)-->
                    </button>                    
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Withdrawal Requests</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="studentDetails" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Binance ID</th>
                              <th>Binance Email</th>
                              <th>USDT(TRC20) Address</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Approval </th>
                            </tr>

                            <?php
                            $queryPayment = "SELECT * FROM `payment_withdrawal` w, `payment_method` p,`user_detail` d WHERE w.`user_id` = p.`user_id` AND w.`user_id` = d.`user_id` AND w.`status` = 0";
                            
                            $execQueryPayment = $db->selectDB($queryPayment);
                   
                            foreach ($execQueryPayment['data'] as $resultPayment) {

                            ?>
                              <tr>
                                <td><?php echo $resultPayment['name'];  ?></td>
                                <td><?php echo $resultPayment['email'];  ?></td>
                                <td><?php echo ucfirst($resultPayment['binance_id']);  ?></td>
                                <td><?php echo $resultPayment['binance_email'];  ?></td>
                                <td><?php echo $resultPayment['binance_address'];  ?></td>
                                <td><?php echo $resultPayment['amount'];  ?></td>
                                <td><?php echo $resultPayment['create_date'];  ?></td>
                                <td><a href="?stid=<?php echo $resultPayment['Withdrawal_id'];  ?>&token=<?php echo $_SESSION['FORM_SECRET'];  ?>">Approval</a></td>
                                
                              </tr>
                            <?php } ?>
                          </thead>
                      </table>
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

 
</body>

</html>

