<?php
$subject = "Get request Form IDX";
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$email_to_send_to = 'sagarsneh@gmail.com';

$txt = 'Name:'.$name.'<br/>'.
	 'Email:'.$email.'<br/>';


$status = mail($email_to_send_to,$subject,$txt,$headers);
echo $status?"<p>Message has been sent</p>":"<p>Message could not be sent.</p>";
