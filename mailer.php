<?php
session_start();

include 'connection.php';
extract($_POST);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$query_email="select * from register where email='{$email}'";
if($conn->query($query_email)->num_rows>0)
{
	echo "Email already registered!')";
}
else
{

require 'include/Exception.php';
require 'include/PHPMailer.php';
require 'include/SMTP.php';

$rand = mt_rand(100000,999999);
if (isset($rand)) {
	$_SESSION['otp']=$rand;
}

$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = "true";

$mail->SMTPSecure= "tls";

$mail->Port = "587";

$mail->Username = "yadavraunak449@gmail.com";

$mail->Password = "Rahul@1998";

$mail->Subject = "Mail OTP Verification";

$mail->isHTML(true);

$mail->setFrom("yadavraunak449@gmail.com");

$mail->Body = "<h1>One Time Password for PHP login authentication is:<br/><br/>" . $rand ."</h1>";

$mail->addAddress($_POST['email']);

if ($mail->Send()) {
	echo "Email sent successfully..";
}
else{
	echo "Send failed";
}

$mail->smtpClose();
}
?>