<?php

require_once 'autoload.php';

use Courier\CourierClient; // import courier client

$baseUrl = "https://api.courier.com/";

// create an instance of courier client by passing the Courier API base URL and the Courier Auth Token to access the Email API.
$mail = new CourierClient($baseUrl, "YOUR-COURIER-AUTH-TOKEN");

// configure the recipient information. Each channel accepts different keys
$notificationId = "YOUR-NOTIFICATION-ID";

$recipientId = "YOUR-RECIPIENT-ID"; // Identify the user by a unique ID.

$emailData = null;

$profile = [
    "firstname" => "firstname",
    "lastname" => "lastname",
    "email" => "recipient@example.com", //email = email address of recipient
];

$profileObject = (object) ['profile' => $profile]; //convert profile array into profile object.

// Get current Unix timestamp
$current_time = time();

// Schedule the notification to be sent 1 day from the current time
$scheduled_time = strtotime('+1 day');

// Calculate the number of seconds between the current time and the scheduled time
$seconds_to_wait = $scheduled_time - $current_time;

// Wait for scheduled time
sleep($seconds_to_wait);

try {
    $response = $mail->sendNotification($notificationId, $recipientId, null, $profileObject, $emailData); // send the email using Courier for the required Notification.
    echo 'Email Sent';
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage() . "\n";
}
