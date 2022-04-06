<?php
session_start();

ob_start();

error_reporting(0);

include('db.php');

$pos1 = strpos($_SERVER['HTTP_USER_AGENT'], '(')+1;
$pos2 = strpos($_SERVER['HTTP_USER_AGENT'], ')')-$pos1;

$ip = $_SERVER['REMOTE_ADDR'];
$host = substr($_SERVER['HTTP_USER_AGENT'], $pos1, $pos2);

$currentFile = $_SERVER["PHP_SELF"];

$parts = Explode('/', $currentFile);
$filename1 = $parts[count($parts) - 1];
$filename2 = $parts[count($parts) - 2];

if(isset($parts[count($parts) - 3])) {

	$filename3 = $parts[count($parts) - 3];

}

if(isset($parts[count($parts) - 4])) {

	$filename4 = $parts[count($parts) - 4];

}

if(isset($_SESSION['authenticate'])) {
	
	$sql = "SELECT * FROM users WHERE user_no = '$_SESSION[user_no]'";
	$result = mysqli_query($connect,$sql) or die("Couldn't execute query user.");
	$row = mysqli_fetch_assoc($result);

	// Overdraft limit
	$sql_overdraft = "SELECT * FROM overdrafts WHERE user = '$row[user_no]' ORDER BY overdraft_no DESC LIMIT 0 , 1";
	$result_overdraft = mysqli_query($connect,$sql_overdraft) or die("Couldn't execute query overdrafts");
	$row_overdraft = mysqli_fetch_assoc($result_overdraft); $num_overdraft = mysqli_num_rows($result_overdraft);

	// Spending and Saving threshold
	$sql_ss = "SELECT * FROM spending_saving WHERE user = '$row[user_no]' ORDER BY ss_no DESC LIMIT 0 , 1";
	$result_ss = mysqli_query($connect,$sql_ss) or die("Couldn't execute query spending_saving");
	$row_ss = mysqli_fetch_assoc($result_ss); $num_ss = mysqli_num_rows($result_ss);
			
}

?>
