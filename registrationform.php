<?php
include 'connection.php';

session_start();

extract($_POST);

$otpfield= $_POST['otpfield'];

if ($otpfield != $_SESSION['otp']) {
	echo "Otp incorrect";
}
else{
$rawdate = htmlentities($_POST['birthday']);
$birth = date('Y-m-d', strtotime($rawdate));

$query= "INSERT INTO register(parents, email, sname, sgender, sbirthday, contact, received, address, city, zipcode) VALUES ('$parents','$email','$sname','$gender','$birth','$mobile','$text','$address','$city','$code')";
if($conn->query($query)){
	echo 1;
}
else{
	echo 0;
}

}
?>