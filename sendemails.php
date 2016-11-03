<?php
require_once('config.php');
require_once('session2.php');
$email=$_POST['emailto'];
$subject=$_POST['subject'];
$message=$_POST['message'];?>

<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

define('GUSER', 'bisma@laraveldevelopers.co'); // GMail username
define('GPWD', 'Bisma2015'); // GMail password
DEFINE('WEBSITE_URL', 'http://localhost');

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'a2plcpnl0869.prod.iad2.secureserver.net'; //smtp.gmail.com';
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
if (smtpmailer($email, 'techrisersnedcis@gmail.com', $subject, 'erp', $message)) {
	// Finish the page:
     $msg='<div class="success">!Mail Sent Successfully </div>';	
}
?>
<script>
alert('Mail Sent Succsessfully');
window.location = "sales.php";
</script>


