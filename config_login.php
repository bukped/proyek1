<?php


require_once 'vendor/autoload.php';

$clientId = '1066197978440-4gm046aa467cqnr8nqeh6e613a9d7dv0.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/toko/sign_in.php';

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('profile');
$client->addScope('email');