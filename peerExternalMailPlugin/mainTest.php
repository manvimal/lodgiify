<?php
require_once "Mail.php";

	

if ((isset($_REQUEST['contactName'])) && (!empty($_REQUEST['contactName'])) ){
			$contactName = $_REQUEST['contactname'];
	
	}
	
	if ((isset($_REQUEST['email'])) && (!empty($_REQUEST['email'])) ){
			$contactemail = $_REQUEST['email'];

	}
	
	if ((isset($_REQUEST['contactsubject'])) && (!empty($_REQUEST['contactsubject'])) ){
			$contactsubject = $_REQUEST['contactsubject'];
			$subject = "Contact US" . ': ' .$contactsubject;

	}
	
	if ((isset($_REQUEST['desc'])) && (!empty($_REQUEST['desc'])) ){
			$desc = $_REQUEST['desc'];

	}


	

$from = $contactemail;
$to = '<lokeshpravin@gmail.com>';
$subject = $subject;
$body = $desc;

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);



    $headers_ = 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'lokeshpravin@gmail.com',
        'password' => 'JEFFHARDY747474'
    ));

$mail = $smtp->send($to, $headers, $body, $headers_);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}

?>