<?php

require_once 'autoload.php';

use Courier\CourierClient; // import courier client

$baseUrl = "https://api.courier.com/";

// create an instance of courier client by passing the Courier API base URL and the Courier Auth Token to access the Email API.
$mail = new CourierClient($baseUrl, "YOUR-COURIER-AUTH-TOKEN");

// configure the recipient information. Each channel accepts different keys
$notificationId = "YOUR-NOTIFICATION-ID";

// Identify the user by a unique ID.
$recipient = "YOUR-RECIPIENT-ID";

$emailData = null;

$profile = [
    "firstname" => "firstname",
    "lastname" => "lastname",
    "email" => "recipient@example.com", //email = email address of recipient
];

//convert profile array into profile object.
$profileObject = (object) ['profile' => $profile];

try {
    $response = $mail->sendNotification($notificationId, $recipient, null, $profileObject, $emailData); // send the email using Courier for the required Notification.
    echo 'Email Sent';
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
