<?php
define('GUSER', 'bisma@ayazahmed.com'); // GMail username
define('GPWD', 'Bisma2015'); // GMail password
DEFINE('WEBSITE_URL', 'http://localhost');
$email="bisma.ayaz@yahoo.com";

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'bullehshah.corpservers.net'; //smtp.gmail.com';
	$mail->Port = 465; //465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send())
	{
		$error = 'Mail error: '.$mail->ErrorInfo; 
		echo $error;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}


				$message = " To Reset Password, please click on this link:\n\n";
                $message .= WEBSITE_URL . '/HRMS/reset.php?email=' . urlencode($email) . "";	
		

if (smtpmailer($email, 'techrisersnedcis@gmail.com', 'HRMS| Reset Password', 'FORGET PASSWORD', $message)) {
	// Finish the page:
     $msg='<div class="success">! Reset Password email has been sent to '.$email.' Please click on the Link to Reset Your Password </div>';	
}
?>