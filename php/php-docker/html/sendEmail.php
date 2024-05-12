<?php
// Skapa ett nytt curl-anrop
$ch = curl_init();

// Ange URL:en för målet (Mailgun API)
curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox194c82deb79342eca6f4bd265f08d58a.mailgun.org/messages');

// Aktivera HTTP Basic Authentication
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

// Ange användarnamn och lösenord för Basic Authentication
curl_setopt($ch, CURLOPT_USERPWD, 'api:ad234a9b32fbb7782e427e212be18525-ed54d65c-6ad02178');

// Ange att vi ska skicka POST-data
curl_setopt($ch, CURLOPT_POST, 1);

// Ange form-fält som ska skickas
$formFields = [
    'from' => 'postmaster@sandbox194c82deb79342eca6f4bd265f08d58a.mailgun.org',
    'to' => 'jennika.elisson@gmail.com',
    'subject' => 'hello',
    'text' => 'first email'
];
curl_setopt($ch, CURLOPT_POSTFIELDS, $formFields);

// Utför curl-anropet
$response = curl_exec($ch);

// Kontrollera för eventuella fel
if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Stäng curl-resursen
curl_close($ch);

?>