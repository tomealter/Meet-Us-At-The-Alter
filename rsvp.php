<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meet Us At The Alter</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS -->
    <link href="style.css" rel="stylesheet">
    
    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Alex+Brush|Pompiere|Alegreya+SC:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="scroll.js"></script>
    <script type="text/javascript" src="modals.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
		.php-response h5{
			font-family: 'Pompiere';
			font-size: 2.5em; 
			text-align: center;
		}
		
		.php-response{
			display:block;
			margin:150px auto 0;
		}
	</style>
    
</head>  


<?php

define('DB_NAME', 'TNwedding');
define('DB_USER', 'TNwedding');
define('DB_PASSWORD', 'Brave@123');
define('DB_HOST', 'TNwedding.db.6830434.hostedresource.com');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if(!$link){
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if(!$db_selected){
	die('Cant use ' . DB_NAME . ': ' . mysql_error());
}

 

//RSVP FORM RETURN / WRITE
$lName = $_POST['lName'];
$fName = $_POST['fName'];
$email = $_POST['email'];
$guests = (int)$_POST['guests'];
$meal = $_POST['meal'];
$attending = $_POST['attending'];
$accessCode = $_POST['accessCode'];


//define the subject of the email
$subject = 'Nicole and Tommy Wedding RSVP Confirmation!'; 
//define the message to be sent. Each line should be separated with \n
$message = "Thanks for taking the time to RSVP!\n\n
You have successfully RSVP'd to Nicole and Tommy's Wedding on July 2nd, 2016. Your RSVP details have been recorded as follows:\n\n
First Name: " . $fName . "\n
Last Name: " . $lName . "\n
Attending: " . $attending . "\n 
Guest Total: " . $guests . "\n\n
If any of this information is not correct, please reply to this email or reach out to Tommy and Nicole.\n\n
Thanks!
Nicole & Tommy
"; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: nicoletommywedding@gmail.com\r\nReply-To: nicoletommywedding@gmail.com";

$rsvpCode = '2birds1stone';

$queryEmail = mysql_query("SELECT email FROM rsvp WHERE email = '$email'");

if($accessCode != $rsvpCode){
	echo '<div class="php-response">';
    echo '<h5>Sorry, you must have a Confirmation Code to RSVP.</h5>';
    echo '<a class="button hotel-button" href="http://meetusatthealter.com#rsvp">RETURN TO THE WEBSITE</a>';
	echo '</div>';
}
else if ($lName == null || $fName == null || $email == null){
	echo '<div class="php-response">';
	echo '<h5>Please provide a First Name, Last Name and Email Adress!</h5>';
	echo '<a class="button hotel-button" href="http://meetusatthealter.com#rsvp">RETURN TO THE WEBSITE</a>';
	echo '</div>';
}
else if (mysql_num_rows($queryEmail) != 0){
	echo '<div class="php-response">';
	echo '<h5 class="php-response">It appears you have already submitted an RSVP. If you wish to change your answer please contact Tommy or Nicole.</h5>';
	echo '<a class="button hotel-button" href="http://meetusatthealter.com#rsvp">RETURN TO THE WEBSITE</a>';
	echo '</div>';
}
else{
	$sql = "INSERT INTO rsvp (attending, lName, fName, email, meal, guests) VALUES ('$attending', '$lName', '$fName', '$email', '$meal', '$guests')";
	if (!mysql_query($sql)) {
		echo '<div class="php-response">';
		die('ERROR: ' . mysql_error());
		echo '<h5>Sorry, something went wrong. Please go back and try again!</h5>';
		echo '<a class="button hotel-button" href="http://meetusatthealter.com#rsvp">RETURN TO THE WEBSITE</a>';
		echo '</div>';
	}
	else if($attending == "Yes"){
		//send RSVP confirmation email
		$mail_sent = @mail( $email, $subject, $message, $headers );
		
		//send a copy of the RSVP email to us
		$mail_sent = @mail( 'nicoletommywedding@gmail.com', $subject, $message, $headers );
		
		echo '<div class="php-response">';
		echo '<h5>Thank you for Resonding. We look forward to seeing you there!</h5>';	
		echo $mail_sent ? "<h5>A confirmation email has been sent to your email address.</h5>" : "<h5>Confirmation email failed, please contact Tommy or Nicole.</h5>";
		echo '<a class="button hotel-button" href="http://meetusatthealter.com#rsvp">RETURN TO THE WEBSITE</a>';
		echo '</div>';
	}
	else{
		//send RSVP confirmation email
		$mail_sent = @mail( $email, $subject, $message, $headers );
		
		//send a copy of the RSVP email to us
		$mail_sent = @mail( 'nicoletommywedding@gmail.com', $subject, $message, $headers );
		
		echo '<div class="php-response">';
		echo '<h5>Thank you for Resonding! Sorry you will not be able to make it.</h5>';	
		echo $mail_sent ? "<h5>A confirmation email has been sent to your email address.</h5>" : "<h5>Confirmation email failed, please contact Tommy or Nicole.</h5>";
		echo '<a class="button hotel-button" href="http://meetusatthealter.com#rsvp">RETURN TO THE WEBSITE</a>';
		echo '</div>';
	}
};  
  
?>


</html>