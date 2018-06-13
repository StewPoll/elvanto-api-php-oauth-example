<?php

include 'api-php/Elvanto_API.php';

$client_id = getenv('ELV_CLIENT_ID');
$client_secret = getenv('ELV_CLIENT_SECRET');

$redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$scope = "ManagePeople";

$elvanto_tokens = new Elvanto_API([]);

$code = $_GET['code'];

$tokens = $elvanto_tokens->exchange_token(
    $client_id, $client_secret, $redirect_url, $code
);

$auth = array('access_token' => $tokens->access_token, 'refresh_token' => $tokens->refresh_token);

// In Reality you would now save these tokens ~somewhere~ (Session storage in database, against a profile etc)
// For the purposes of the example. we'll make a simple API call to start off with, to get the details about the
// logged in users!

$elvanto = new Elvanto_API($auth);

$results = $elvanto->call('people/currentUser');

?>
<html>
<head>
    <title>Oauth Testing Results Page</title>
</head>
<body>
<h1>Results!</h1>
<p>Below are your details!</p>
<pre>
    <?php
    echo json_encode((array) $results, JSON_PRETTY_PRINT)
    ?>
</pre>
<p>Would you like to start again? If so <a href="/">click here</a>.</p>
</body>
</html>
