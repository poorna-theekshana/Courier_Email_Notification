<?php

require_once 'autoload.php';

ini_set('max_execution_time', 300); // 300 seconds = 5 minutes

use Courier\CourierClient; // import courier client

function myScheduledFunction()
{

    $baseUrl = "https://api.courier.com/";

// create an instance of courier client by passing the Courier API base URL and the Courier Auth Token to access the Email API.
    $mail = new CourierClient($baseUrl, "YOUR-COURIER-AUTH-TOKEN");

// configure the recipient information. Each channel accepts different keys
    $notificationId = "YOUR-NOTIFICATION-ID";

    $recipientId = "YOUR-RECIPIENT-ID"; // Identify the user by a unique ID.

    $emailData = null;

    $profile = [
        "firstname" => "Johnny",
        "lastname" => "Appleseed",
        "email" => "recipient@example.com", //email = email address of recipient - recipient@example.com
    ];

    $profileObject = (object) ['profile' => $profile];

    try {
        $response = $mail->sendNotification($notificationId, $recipientId, null, $profileObject, $emailData); // send the email using Courier for the required Notification.
        echo 'Email Sent';
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . "\n";
    }
};

// Get current Unix timestamp
$current_time = time();

// Schedule the first notification to be sent 1 minute from the current time
$scheduled_time = strtotime('+1 minutes');

// Calculate the number of seconds between the current time and the scheduled time
$seconds_to_wait = $scheduled_time - $current_time;

// Wait for scheduled time
sleep($seconds_to_wait);

// This loop will call myScheduledFunction() 5 times, waiting for 1 minute between each call.
for ($x = 0; $x <= 5; $x++) {
    myScheduledFunction();
    sleep(60);
}
