<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['workshops'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$workshops = Array();
foreach ($_POST['workshops'] as $raw_workshop) {
    $workshops[] = strip_tags(htmlspecialchars($raw_workshop));
}

   
// Create the email and send the message
$to = 'registration-fosdemx@fosdem.org'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "$name registered for a workshop.";
$email_body = "$name registered for a workshop:\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nWorkshops:\n".implode("\n", $workshops);
$headers = "From: fosdemx@fosdem.org\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;         
