<?php


function register ($name, $email, $workshops) {
    $body = "$name registered for a workshop:\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nWorkshops:\n".implode("\n", $workshops);
    $headers = "From: fosdemx-registration@fosdem.org\nReply-To: $email";
    mail(
        'fosdemx-registration@fosdem.org',
        "$name registered for a workshop",
        $body,
        $headers
    );
}

function confirm($name, $email, $workshops) {
    $body = "Confirmation of your registration:\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nWorkshops:\n".implode("\n", $workshops);
    $headers = "From: no-reply@fosdem.org\nReply-To: fosdemx-registration@fosdem.org";
    mail(
        $email,
        "Confirmation of your registration",
        $body,
        $headers
    );
}

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
register($name, $email_address, $workshops);
// Also mail a confirmation to the original sender
confirm($name, $email_address, $workshops);
return true;
