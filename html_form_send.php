<?php
if(isset($_POST['email'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "contact@andygates.co.uk";
     
    $email_subject = "Website Enquiries";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['name']) ||
    	!isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 2) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 

 
 
<!-- Success html below -->
<!DOCTYPE HTML>
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="10; url=http://www.andygates.co.uk">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>Thank you</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="javascript">
var max_time = 10;
var cinterval;
function countdown_timer(){
max_time--;
document.getElementById('countdown').innerHTML = max_time;
if(max_time == 0){
clearInterval(cinterval);
}}
cinterval = setInterval('countdown_timer()', 1000);
</script>
</head>
    <body>
        <section id="About">
        <h4><span id="countdown">10</span></h4>
        <h4>Thank you for contacting me. <br>I will be in touch with you very soon.</h4>
        <p>If you are not redirected automatically, please follow. <a href='http://www.andygates.co.uk'>www.andygates.co.uk</a></p>
        </section>
    </body>
</html>

<!-- Localized -->
 
 <?php
}
die();
?>
 
