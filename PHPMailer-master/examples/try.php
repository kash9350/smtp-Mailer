<?php 
require_once '../PHPMailerAutoload.php';
 
$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
 
class phpmailerAppException extends phpmailerException {}
 
try {
$to = $_POST['From_Email'];
if(!PHPMailer::validateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->isSMTP();
$mail->SMTPDebug  = 2;
$mail->Host       = $_POST['smtp_server'];
$mail->Port       = $_POST['smtp_port'];
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth   = true;
$mail->Username   = $_POST['From_Email'];
$mail->Password   = $_POST['password'];
$mail->addReplyTo($_POST['From_Email'], $_POST['From_Name']);
$mail->setFrom($_POST['From_Email'], $_POST['From_Name']);
$mail->addAddress($_POST['To_Email'], $_POST['To_Name']);
$mail->Subject  = $_POST['Subject'];
$body = $_POST['Message'];
$mail->WordWrap = 78;
$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
//$mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png');  // optional name
//$mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name
 
try {
  $mail->send();
  $results_messages[] = "Message has been sent using SMTP";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}
 
if (count($results_messages) > 0) {
//   echo "<h2>Run results</h2>\n";
//   echo "<ul>\n";
// foreach ($results_messages as $result) {
//   echo "<li>$result</li>\n";
// }
// echo "</ul>\n";
	header('Location: successful.html');  
}
?>
