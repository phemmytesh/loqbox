<?php
include('../../includes/global.php'); include('../../includes/auth.php'); 

if(isset($_GET['sec'])) {
	echo "<meta http-equiv='refresh' content='0;url=".$server."/app/transactions/#table'>"; exit();
}

$sql_ann = "SELECT * FROM transactions WHERE user = '$row[user_no]' ORDER BY posteddate DESC";
$result_ann = mysqli_query($connect,$sql_ann) or die("Couldn't execute query transactions.");
$row_ann = mysqli_fetch_assoc($result_ann); $num_ann = mysqli_num_rows($result_ann);

$sql_titles = "SELECT * FROM titles ORDER BY title_no DESC";
$result_titles = mysqli_query($connect,$sql_titles) or die("Couldn't execute query titles.");
$row_titles = mysqli_fetch_assoc($result_titles); $num_titles = mysqli_num_rows($result_titles);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>transactions - Account Ledger | Loqbox</title>
    <?php include('../../includes/meta.php'); ?>

</head>

<body>

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include('../../includes/left-panel.php'); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include('../../includes/head-panel.php'); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->    
    <div class="br-mainpanel">
    
    	<div class="br-pageheader pd-y-15 pd-l-20" style="margin-left:-10px">
        	<nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="<?php echo $server; ?>/app">Dashboard</a>
                <span class="breadcrumb-item active">Transactions</span>
        	</nav>
		  </div><!-- br-pageheader -->
      
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        	<h4 class="tx-gray-800 mg-b-5">Transactions</h4>
            <p class="mg-b-0">Add a transaction</p>
        </div>
        
        <div class="br-pagebody">
        	<div class="br-section-wrapper">
            	<form name="form" id="form" action="process/" method="post">
                <input type="hidden" name="action" value="new">
            		<div class="form-layout form-layout-6">

                    <div class="row no-gutters">
                      <div class="col-5 col-sm-3">
                        Log: <span class="tx-danger">*</span>
                      </div><!-- col-4 -->
                      <div class="col-7 col-sm-9">
                        <select id="logType" class="form-control select2-show-search" name="logType" required>
                            <option value="0">Log transaction type</option>
                            <option value="1">Deposit</option>
                            <option value="2">Withdrawal</option>
                        </select>	
                      </div><!-- col-8 -->
                    </div><!-- row -->

                    <div class="row no-gutters">
                      <div class="col-sm-12" style="background-color:#FFF; border-left:none">
                      </div><!-- col-8 -->
                    </div><!-- row -->

                </div>

                <div class="form-layout mg-t-30 mg-b-30">

                  <div class="row">

                    <div class="col-lg-4">
                      <div class="input-group">
                        <span class="input-group-addon tx-16 tx-danger">£</span>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" maxlength="9" required>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon ion-calendar tx-20 lh-0 op-6"></i></span>
                          <input type="text" id="log_date" name="log_date" class="form-control" placeholder="MM/DD/YYYY Set Log Date" required>
                        </div>  
                    </div>
                	  <div class="col-lg-4">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-clock-o tx-22 lh-0 op-6"></i></span>
                          <input id="tp_time" type="text" name="log_time" class="form-control" placeholder="Set Log time" required>
                        <button id="log_time" type="button" class="btn btn-primary mg-l-10" style="cursor:pointer">Set Current Time</button>
                        </div>
                    </div>

                  </div>

                  <script src="<?php echo $server; ?>/js/numberformat.js"></script>

                </div>

            		<div class="form-layout form-layout-6">

                    <div class="row no-gutters">
                      <div class="col-sm-12" style="background-color:#FFF; border-left:none">
                      </div><!-- col-8 -->
                    </div><!-- row -->
                  
                    <div class="row no-gutters">
                      <div class="col-5 col-sm-3">
                        Title: <span class="tx-danger">*</span>
                      </div><!-- col-4 -->
                      <div class="col-7 col-sm-9">
                        <select id="title" class="form-control select2-show-search" name="title" required>
                          <option value="0">Choose a Title</option>
                          <?php if($num_titles) { do { ?>
                              <option value="<?php echo $row_titles['title_no']; ?>"><?php echo $row_titles['title']; ?></option>
                          <?php } while($row_titles = mysqli_fetch_assoc($result_titles)); } ?>
                        </select>	
                      </div><!-- col-8 -->
                    </div><!-- row -->
                    <div class="row no-gutters">
                      <div class="col-5 col-sm-3">
                        Description:
                      </div><!-- col-4 -->
                      <div class="col-7 col-sm-9">
                        <input class="form-control" type="text" id="description" name="description" maxlength="50">
                      </div><!-- col-8 -->
                    </div><!-- row -->
                                        
                    <div class="row no-gutters">
                      <div class="col-sm-12" style="background-color:#FFF; border-left:none">
                      </div><!-- col-8 -->
                    </div><!-- row -->
                    
                    <div class="row no-gutters">
                      <div class="col-5 col-sm-3">
                        Security: <span class="tx-danger">*</span>
                      </div><!-- col-4 -->
                      <div class="col-7 col-sm-9">
                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter Account Password" maxlength="15">
                      </div><!-- col-8 -->
                    </div><!-- row -->
                                    
                    <div class="row no-gutters">
                      <div class="col-5 col-sm-3">
                        &nbsp;
                      </div><!-- col-4 -->
                      <div class="form-layout-footer col-7 col-sm-9 bd pd-20 bd-t-0">
                        <input class="btn btn-primary" id="submit" type="submit" style="cursor:pointer" value="Add Transaction"> 
                      </div><!-- col-8 -->
                    </div><!-- row -->
                        
              	</div><!-- form-layout -->
             </form>   
             <div id="message" style="width:100%"></div>
             
          <p class="tx-11 tx-uppercase tx-spacing-2 mg-t-40 mg-b-10 tx-gray-600">Notes</p>
          <pre><code class="javascript pd-20">
          This will add a new transaction.
          See all transactions in the table below
          </code></pre>
             
            </div><!-- br-section-wrapper -->
          </div><!-- br-pagebody -->
          
          <div class="br-pagebody">
            <div class="br-section-wrapper">
            
                  <div class="table-wrapper">
                  
                    <a name="table"></a>
                    <table id="datatable" class="table display responsive nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th class="wd-5p">SN</th>
                          <th class="wd-5p">Delete</th>
                          <th class="wd-5p">ID</th>
                          <th class="wd-10p">Amount</th>
                          <th class="wd-5p">Overdraft</th>
                          <th class="wd-10p">Title</th>
                          <th class="wd-40p">Description</th>
                          <th class="wd-20p">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($num_ann != 0) { $i = 1; do { ?>
                        <tr>
                        
                          <td><?php echo $i++; ?></td>
                          
                          <td>       
                            <a href="<?php echo $server."/app/transactions/process/?action=delete&no=".$row_ann['transaction_no']."&id=".$row_ann['transactionID']."&amount=".$row_ann['amount']."&logType=".$row_ann['logType']; ?>" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row_ann['transactionID']; ?>" onClick="return confirm('Are you sure..? This will the delete the transaction <?php echo $row_ann['transactionID']; ?>.');"><div style="height:22px"><i class="fa fa-close"></i></div></a>
                          </td>

                          <td>
                            <?php echo $row_ann['transactionID']; ?>
                          </td>

                          <td class="<?php if($row_ann['logType'] == 2) { echo 'tx-danger'; } else { echo 'tx-success'; } ?>">
                            <?php if($row_ann['logType'] == 2) { echo '-'; } else { echo '+'; } echo '£'.number_format($row_ann['amount'],2); ?>
                          </td>

                          <td class="<?php if($row_ann['overdraft'] == 'true') { echo 'tx-danger'; } else { echo 'tx-success'; } ?>">
                            <?php if($row_ann['overdraft'] == 'true') { echo 'Yes'; } elseif($row_ann['overdraft'] == 'false') { echo 'No'; } else { echo '-'; } ?>
                          </td>
                          
                          <td style="font-weight: 400; letter-spacing: 1px; word-spacing: 2px">
                            <?php 
                              $sql_title = "SELECT * FROM titles WHERE title_no = '$row_ann[title]'";
                              $result_title = mysqli_query($connect,$sql_title) or die("Couldn't execute query title.");
                              $row_title = mysqli_fetch_assoc($result_title); $num_title = mysqli_num_rows($result_title);                           
                              echo $row_title['title']; 
                            ?>
                          </td>

                          <td>
                            <?php echo $row_ann['description']; ?>
                          </td>
                                            
                          <td><?php echo date("Y M d D g:ia",strtotime($row_ann['posteddate'])); ?></td>
                          
                        </tr>
                       <?php } while($row_ann = mysqli_fetch_assoc($result_ann)); } ?>
                      </tbody>
                    </table>
                  </div><!-- table-wrapper -->
                  
                  <p class="tx-11 tx-uppercase tx-spacing-2 mg-t-40 mg-b-10 tx-gray-600">Notes</p>
                  <pre><code class="javascript pd-20">
                  Hover your pointer on the icons to see their actions. 
                  </code></pre>
            
            </div><!-- br-section-wrapper -->
          </div><!-- br-pagebody -->

		<?php include('../../includes/footer.php'); ?>
        
    </div>

    <!-- ########## END: MAIN PANEL ########## -->
    
    <?php include('../../includes/scripts.php'); ?>

</body>
</html>
