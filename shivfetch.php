<?php
$curl = curl_init();

$email = $_POST['email-input'];
$date = $_POST['date-input'];
$time = $_POST['time'];

// Combine the date and time inputs into a single string
$datetime = $date . ' ' . $time;

// Convert the date and time string to a Unix timestamp
$timestamp = strtotime($datetime);

$json_data = '{
    "personalizations": [
        {
            "to": [
                {
                    "email": "' . $email . '"
                }
            ],
            "subject": "Scheduled Email"
        }
    ],
    "from": {
        "email": "from_address@example.com"
    },
    "content": [
        {
            "type": "text/plain",
            "value": "Hello, World!"
        }
    ],
}';

curl_setopt_array($curl, [
    CURLOPT_URL => "https://rapidprod-sendgrid-v1.p.rapidapi.com/mail/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $json_data,
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: rapidprod-sendgrid-v1.p.rapidapi.com",
        "X-RapidAPI-Key: 8b49ead8f1mshfa7d6ec63a2d153p195bb2jsna1d40da4e20a",
        "content-type: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo "Email scheduled for " . $datetime;
}
?>