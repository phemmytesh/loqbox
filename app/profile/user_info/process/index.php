<?php
include('../../../../includes/global.php'); include('../../../../includes/auth.php'); 

if (!$_POST) exit;

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
	
$password = trim(str_replace("'","",str_replace('"','',$_POST['password'])));

$sql_pwd = "SELECT * FROM users WHERE user_no = '$row[user_no]' AND password = md5('$password')";
$result_pwd = mysqli_query($connect,$sql_pwd) or die("Couldn't execute query security."); 
$num_pwd = mysqli_num_rows($result_pwd); $row_pwd = mysqli_fetch_assoc($result_pwd);

if (trim($password) == '') {
	echo '<div class="error_message">Attention! Please enter your password</div>';
	exit();
} elseif ($num_pwd == 0) { // current password is not correct
	echo '<div class="error_message">Attention! Password is incorrect</div>';
	exit();
}

// Email address verification, do not edit.
function isEmail($email) {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

// Phone verification, do not edit.
function isPhone($phone) {
    return(preg_match("/^\+([0-9]{1,4})\)?[-. ]?([0-9]{10})$/", $phone));
}

$first_name = trim(addslashes($_POST['first_name']));
$last_name = trim(addslashes($_POST['last_name']));
$email = trim(strtolower($_POST['email']));
$occupation = trim(addslashes($_POST['occupation']));
$phone = trim($_POST['phone']);

if (trim($first_name) == '') {
	echo '<div class="error_message">Attention! Please enter your first name</div>';
	exit();
} elseif (trim($last_name) == '') {
	echo '<div class="error_message">Attention! Please enter your last name</div>';
	exit();
} elseif (trim($email) == '') {
	echo '<div class="error_message">Attention! Please enter your email address</div>';
	exit();
} elseif (trim($email) != '' && !isEmail($email)) {
    echo '<div class="error_message">Attention! You have entered an invalid email address</div>';
    exit();
} elseif (trim($occupation) == '') {
	echo '<div class="error_message">Attention! Please enter your occupation</div>';
	exit();
} elseif (trim($phone) == '') {
	echo '<div class="error_message">Attention! Please enter your phone number</div>';
	exit();
} elseif (trim($phone) != '' && !isPhone($phone)) {
    echo '<div class="error_message">Attention! You have entered an invalid mobile phone number. Example is +447777777777</div>';
    exit();
}

// Update User details
$UpdateRecords_info = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', occupation = '$occupation', dateupdated = '$dateposted', editedby = '$row[user_no]', ip = '$ip', host = '$host' WHERE user_no = '$row[user_no]'";
$Update_info = mysqli_query($connect,$UpdateRecords_info) or die("Couldn't execute update user information");

// Add log to Activities Table
$description = $row['first_name'] . " " . $row['last_name'] . " updated profile information";
$sql_act = "INSERT INTO user_activities (description,user_no,ip,host,dateposted) VALUES ('$description','$row[user_no]','$ip','$host','$dateposted')";
$result_act = mysqli_query($connect,$sql_act) or die("Couldn't execute insert query activities.");
					 
/* Success feedback */
echo "<fieldset>";
echo "<div id='success_page'>";
echo "<div class='alert-success' role='alert'><div class='d-flex align-items-center justify-content-start'><i class='icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0'></i><span><strong>Well done!</strong> You have successful updated your information.</span></div></div>";
echo "</div>";
echo "</fieldset>";

?>