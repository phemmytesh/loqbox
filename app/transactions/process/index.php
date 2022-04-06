<?php
include('../../../includes/global.php'); include('../../../includes/auth.php'); 

if($_POST) {

	switch ($_POST["action"])
	{
		case "new": 
		
			$password = trim(str_replace("'","",str_replace('"','',$_POST['password'])));
			
			$sql_pwd = "SELECT * FROM users WHERE user_no = '$row[user_no]' AND password = md5('$password')";
			$result_pwd = mysqli_query($connect,$sql_pwd) or die("Couldn't execute query password."); 
			$num_pwd = mysqli_num_rows($result_pwd); $row_pwd = mysqli_fetch_assoc($result_pwd);
			
			if (trim($password) == '') {
				echo '<div class="error_message">Attention! Please enter your password</div>';
				exit();
			} elseif ($num_pwd == 0) { // current password is not correct
				echo '<div class="error_message">Attention! Password is incorrect</div>';
				exit();
			} 
			
			$logType = $_POST['logType'];
			$amount = (float)trim(str_replace(',','',$_POST['amount']));
			$posteddate = date("Y-m-d H:i:s",strtotime($_POST['log_date'] ." ". $_POST['log_time']));
			$title = $_POST['title'];
			$description = (isset($_POST['description']) && trim($_POST['description']) != '') ? trim($_POST['description']) : NULL;

			$overdraft = 'false';
			$target = 'false';
			
			if (trim($logType) == '0') {
				echo '<div class="error_message">Attention! Please select your transaction type</div>';
				exit();
			} else if (trim($amount) == '' || $amount == 0) {
				echo '<div class="error_message">Attention! Please enter an amount greater than 0</div>';
				exit();
			} else if (trim($title) == '0') {
				echo '<div class="error_message">Attention! Please select a title for your transaction</div>';
				exit();
			}

			$sql_transactions = "SELECT * FROM transactions WHERE user = '$row[user_no]' ORDER BY posteddate DESC";
			$result_transactions = mysqli_query($connect,$sql_transactions) or die("Couldn't execute query transactions");
			$row_transactions = mysqli_fetch_assoc($result_transactions); $num_transactions = mysqli_num_rows($result_transactions);
			
			$all_deposits = 0;
			$all_withdrawals = 0;
			
			if($num_transactions) {
			
			  do {
			
				if($row_transactions['logType'] == '1') { $all_deposits = $all_deposits + (float)$row_transactions['amount']; }
				else { $all_withdrawals = $all_withdrawals + (float)$row_transactions['amount']; }
						
			  } while($row_transactions = mysqli_fetch_assoc($result_transactions));
			
			}

			if($logType == 2) { // Withdrawals

				if($all_withdrawals > $all_deposits) {

					$current_overdraft_amount = (float)$all_withdrawals - (float)$all_deposits;
					$overdraft_limit = (float)$row_overdraft['overdraft'];

					if($current_overdraft_amount < $overdraft_limit) {

						$overdraft_balance = $overdraft_limit - $current_overdraft_amount;

						if($amount <= $overdraft_balance) {

							$overdraft = 'true';

						} else {

							echo '<div class="error_message">Attention! The amount entered for withdrawal is greater than your overdraft balance. You cannot exceed your overdraft limit.</div>';
							exit();

						}

					} else {

						echo '<div class="error_message">Attention! You have already reached your overdraft limit.</div>';
						exit();

					}	
	
				} else if($all_withdrawals == $all_deposits) {
	
					$overdraft_balance = $row_overdraft['overdraft'];

					if($amount <= $overdraft_balance) {

						$overdraft = 'true';

					} else {

						echo '<div class="error_message">Attention! The amount entered for withdrawal is greater than your overdraft limit. You cannot exceed your overdraft limit.</div>';
						exit();

					}	
	
				} else if($all_withdrawals < $all_deposits) {
					
					$current_overdraft_surplus = $all_deposits - $all_withdrawals;
					$overdraft_limit = $row_overdraft['overdraft'];
					$overdraft_surplus = $overdraft_limit + $current_overdraft_surplus;

					if($amount > $current_overdraft_surplus && $amount <= $overdraft_surplus) {

						$overdraft = 'true';

					} else if($amount > $overdraft_surplus) {

						echo '<div class="error_message">Attention! The amount entered for withdrawal is greater than your combined account and overdraft balance. You cannot exceed your overdraft limit.</div>';
						exit();

					}

				}

			} else { // Deposits

				$overdraft = NULL;

				$balance = $all_deposits - $all_withdrawals;
				$total_balance = $balance + $amount;

				if($total_balance >= $row_ss['threshold']) { // Threshold for spending and saving choices

					$target = 'true';

				}

			}

			// Generating Random transaction ID
			function GenerateID() {
				$transactionID = '';
				$salt1 = strtoupper("abcdefghijklmnopqrstuvwxyz");
				$salt2 = "1234567890";
				srand((double)microtime()*1000000);  	
				$i = 0;	
				while ($i < 10) {  // changing for other length
					if($i < 2) {
						$num1 = rand() % strlen($salt1);	
						$tmp1 = substr($salt1, $num1, 1);
						$transactionID = $transactionID . $tmp1;	
					} else {
						$num2 = rand() % strlen($salt2);	
						$tmp2 = substr($salt2, $num2, 1);
						$transactionID = $transactionID . $tmp2;	
					}
					$i++;	
				}
				return $transactionID;
			}

			$transactionID = GenerateID();

			/* check if transactionID exists */
			$sql_transactionID_check = "SELECT transactionID FROM transactions WHERE transactionID = '$transactionID'";
			$result_transactionID_check = mysqli_query($connect,$sql_transactionID_check) or die("Cannot connect to server");
			$row_transactionID_check = mysqli_fetch_assoc($result_transactionID_check); $num_transactionID_check = mysqli_num_rows($result_transactionID_check); 

			while ($num_transactionID_check == 1) {
				
				$transactionID = GenerateID();

				$sql_transactionID_check = "SELECT transactionID FROM transactions WHERE transactionID = '$transactionID'";
				$result_transactionID_check = mysqli_query($connect,$sql_transactionID_check) or die("Cannot connect to server");
				$row_transactionID_check = mysqli_fetch_assoc($result_transactionID_check); $num_transactionID_check = mysqli_num_rows($result_transactionID_check); 
					
			}
			
			// Add transaction to transaction table
			$sql_insert_ann = "INSERT INTO transactions (transactionID,user,logType,amount,overdraft,title,description,posteddate,dateposted,postedby,ip,host) VALUES ('$transactionID','$row[user_no]','$logType','$amount','$overdraft','$title','$description','$posteddate','$dateposted','$row[user_no]','$ip','$host')";
			$result_insert_ann = mysqli_query($connect,$sql_insert_ann) or die("Couldn't execute insert query transactions.");
			
			// Add log to Activities Table
			$description = $row['first_name'] . " " . $row['last_name'] . " added a new transaction: " . $transactionID;

			if($overdraft == 'true') { $description .= ', which went into overdraft'; }
			if($target == 'true') { $description .= ', and can now make relevant spending and saving choices'; }

			$sql_act = "INSERT INTO user_activities (description,user_no,ip,host,dateposted) VALUES ('$description','$row[user_no]','$ip','$host','$dateposted')";
			$result_act = mysqli_query($connect,$sql_act) or die("Couldn't execute insert query activities.");
								 
			/* Success feedback */
			echo "<fieldset>";
				echo "<div id='success_page'>";
					echo "<div class='alert-success' role='alert'><div class='d-flex align-items-center justify-content-start'><i class='icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0'></i><span><strong>Well done!</strong> New transaction Added Successfully!";
						if($overdraft == 'true') { 
							echo " And new transaction is also an overdraft.";
						}
						if($target == 'true') { 
							echo " And can now make relevant spending and saving choices.";
						}
					echo " Page will reload with the updated transactions in 4 seconds...</span></div></div>";
				echo "</div>";
			echo "</fieldset>";
			
		break;
		
	}
}

if($_GET) {

	switch ($_GET["action"])
	{
		
		case "delete":

			if($_GET['logType'] == '1') {

				$sql_transactions = "SELECT * FROM transactions WHERE user = '$row[user_no]' ORDER BY posteddate DESC";
				$result_transactions = mysqli_query($connect,$sql_transactions) or die("Couldn't execute query transactions");
				$row_transactions = mysqli_fetch_assoc($result_transactions); $num_transactions = mysqli_num_rows($result_transactions);
				
				$all_deposits = 0;
				$all_withdrawals = 0;
				
				if($num_transactions) {
				
					do {
					
						if($row_transactions['logType'] == '1') { $all_deposits = $all_deposits + (float)$row_transactions['amount']; }
						else { $all_withdrawals = $all_withdrawals + (float)$row_transactions['amount']; }
								
					} while($row_transactions = mysqli_fetch_assoc($result_transactions));
				
				}

				$balance = $row_overdraft['overdraft'] - ($all_withdrawals - $all_deposits);

				if($_GET['amount'] <= $balance) {
			
					// Delete transaction
					$DeleteRecords_ann = "DELETE FROM transactions WHERE transaction_no = '$_GET[no]'";
					$Delete_ann = mysqli_query($connect,$DeleteRecords_ann) or die("Couldn't execute delete query transaction " . $_GET['id']);
					
					// Add log to Activities Table
					$description = $row['first_name'] . " " . $row['last_name'] . " deleted transaction " . $_GET['id'];
					$sql_act = "INSERT INTO user_activities (description,user_no,ip,host,dateposted) VALUES ('$description','$row[user_no]','$ip','$host','$dateposted')";
					$result_act = mysqli_query($connect,$sql_act) or die("Couldn't execute insert query activities.");
					
					$_SESSION['msg'] = "You have successfully deleted transaction " . $_GET['id'];

				} else {

					$_SESSION['msg'] = "You cannot delete this deposit transaction as it would make your account go over your overdraft limit";

				}

			} else {

				// Delete transaction
				$DeleteRecords_ann = "DELETE FROM transactions WHERE transaction_no = '$_GET[no]'";
				$Delete_ann = mysqli_query($connect,$DeleteRecords_ann) or die("Couldn't execute delete query transaction " . $_GET['id']);
					
				// Add log to Activities Table
				$description = $row['first_name'] . " " . $row['last_name'] . " deleted transaction " . $_GET['id'];
				$sql_act = "INSERT INTO user_activities (description,user_no,ip,host,dateposted) VALUES ('$description','$row[user_no]','$ip','$host','$dateposted')";
				$result_act = mysqli_query($connect,$sql_act) or die("Couldn't execute insert query activities.");
					
				$_SESSION['msg'] = "You have successfully deleted transaction " . $_GET['id'];
				
			}

			header("Location: $server/app/transactions/#table");
		
		break;
	}
}
?>