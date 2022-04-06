<?php
include('../includes/global.php'); include('../includes/auth.php'); 

if(isset($_SESSION['pag'])) {
	
	echo "<meta http-equiv='refresh' content='0;url=".$_SESSION['pag']."'>"; 
  unset($_SESSION['pag']); 
  exit();
	
}

$sql_transactions = "SELECT * FROM transactions WHERE user = '$row[user_no]' ORDER BY posteddate DESC";
$result_transactions = mysqli_query($connect,$sql_transactions) or die("Couldn't execute query transactions");
$row_transactions = mysqli_fetch_assoc($result_transactions); $num_transactions = mysqli_num_rows($result_transactions);

$transaction_no = array();
$transactionID = array();
$logType = array();
$amount = array();
$overdraft = array();
$title = array();
$description = array();
$posteddate = array();

$all_deposits = 0;
$all_withdrawals = 0;

if($num_transactions) {

  do {

    if($row_transactions['logType'] == '1') { $all_deposits = $all_deposits + (float)$row_transactions['amount']; }
    else { $all_withdrawals = $all_withdrawals + (float)$row_transactions['amount']; }

    array_push($transaction_no, $row_transactions['transaction_no']);
    array_push($transactionID, $row_transactions['transactionID']);
    array_push($logType, $row_transactions['logType']);
    array_push($amount, $row_transactions['amount']);
    array_push($overdraft, $row_transactions['overdraft']);
    array_push($title, $row_transactions['title']);
    array_push($description, $row_transactions['description']);
    array_push($posteddate, $row_transactions['posteddate']);

  } while($row_transactions = mysqli_fetch_assoc($result_transactions));

}

?>

<head>
    
	<title>Dashboard: Account Ledger | Loqbox</title>
    <?php include('../includes/meta.php'); ?>

</head>
    
<body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include('../includes/left-panel.php'); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include('../includes/head-panel.php'); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
        <p class="mg-b-0">Welcome to your account ledger</p>
      </div><!-- d-flex -->

      <div class="br-pagebody mg-t-5 pd-x-30">
      
        <div class="row row-sm">

          <div class="col-sm-6 col-xl-4">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total Transactions</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo number_format($num_transactions); ?></p>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
          
          <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
            <div class="bg-danger rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-person tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Overdraft Balance</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo '£'; if($all_deposits >= $all_withdrawals) { echo number_format($row_overdraft['overdraft'],2); } else { echo number_format(($row_overdraft['overdraft'] - ($all_withdrawals - $all_deposits)),2); } ?></p>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
  
          <div class="col-sm-12 col-xl-4 mg-t-20 mg-xl-t-0">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Current Balance</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo '£'; if($all_deposits > $all_withdrawals) { echo number_format(($all_deposits - $all_withdrawals),2); } else { echo '0.00'; } ?></p>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
          
        </div><!-- row -->

        <div class="row row-sm mg-t-20">

          <div class="col-lg-4">

            <div class="col-12">
              <div class="bg-secondary rounded overflow-hidden">
                <div class="pd-25 d-flex align-items-center">
                  <div class="mg-l-20">
                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Your Overdraft Limit</p>
                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo '£'.number_format($row_overdraft['overdraft'],2); ?></p>
                  </div>
                </div>
              </div>
            </div><!-- col-3 -->

            <div class="col-12 mg-t-20">
              <div class="bg-secondary rounded overflow-hidden">
                <div class="pd-25 d-flex align-items-center">
                  <div class="mg-l-20">
                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Your Savings Target</p>
                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1"><?php echo '£'.number_format($row_ss['threshold'],2); ?></p>
                  </div>
                </div>
              </div>
            </div><!-- col-3 -->

          </div>

          <div class="col-lg-8 mg-t-20 mg-xl-t-0">
            <div class="card pd-0 bd-0 shadow-base">
              <div class="pd-x-30 pd-t-30 pd-b-15">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Recent Transactions</h6>
                    <p class="mg-b-0"></p>
                  </div>
                  <div class="tx-13">
                    <p class="mg-b-0" style="text-align: right"><a href="<?php echo $server; ?>/app/transactions">Log New Transaction</a></p>
                  </div>
                </div>
              </div>
              <div class="pd-x-30">

                  <div class="table-wrapper">
                  
                    <a name="table"></a>
                    <table id="datatable2" class="table display responsive nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th class="wd-10p">ID</th>
                          <th class="wd-15p">Amount</th>
                          <th class="wd-10p">Overdraft</th>
                          <th class="wd-45p">Title</th>
                          <th class="wd-20p">Date</th>
                        </tr>
                      </thead>
                      <tbody class="tx-13">

                      <?php if($num_transactions != 0) { $i = 1; foreach($transaction_no as $key => $value) { if($i < 6) {
                        
                        $sql_title = "SELECT * FROM titles WHERE title_no = '$title[$key]'";
                        $result_title = mysqli_query($connect,$sql_title) or die("Couldn't execute query title.");
                        $row_title = mysqli_fetch_assoc($result_title); $num_title = mysqli_num_rows($result_title); 

                      ?>
                        <tr>
                                                  
                          <td>
                            <?php echo $transactionID[$key]; ?>
                          </td>

                          <td class="<?php if($logType[$key] == 2) { echo 'tx-danger'; } else { echo 'tx-success'; } ?>">
                            <?php if($logType[$key] == 2) { echo '-'; } else { echo '+'; } echo '£'.number_format($amount[$key],2); ?>
                          </td>

                          <td class="<?php if($overdraft[$key] == 'true') { echo 'tx-danger'; } else { echo 'tx-success'; } ?>">
                            <?php if($overdraft[$key] == 'true') { echo 'Yes'; } elseif($overdraft[$key] == 'false') { echo 'No'; } else { echo '-'; } ?>
                          </td>
                          
                          <td style="font-weight: 400; letter-spacing: 1px; word-spacing: 2px">
                            <?php 
                              echo $row_title['title']; 
                            ?>
                          </td>
                                            
                          <td><?php echo date("Y M d D g:ia",strtotime($posteddate[$key])); ?></td>
                          
                        </tr>
                        <?php $i++; } } unset($i); unset($key); unset($value); } ?>
                      </tbody>
                    </table>
                  </div><!-- table-wrapper -->
                
              </div>
            </div><!-- card -->
          </div>
          
        </div><!-- row -->            

      </div><!-- br-pagebody -->
      
      <?php include('../includes/footer.php'); ?>
    
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <?php include('../includes/scripts.php'); ?>
    
</body>
</html>
