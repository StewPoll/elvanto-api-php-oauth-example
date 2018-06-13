<?php

include 'api-php/Elvanto_API.php';

$client_id = getenv('ELV_CLIENT_ID');
$client_secret = getenv('ELV_CLIENT_SECRET');


$redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/success.php';

$scope = "ManagePeople";
// Full list of available scopes: https://www.elvanto.com/api/getting-started/#oauth

$elvanto = new Elvanto_API([]);

$url = $elvanto->authorize_url($client_id, $redirect_url, $scope);

?>
<html>
<head>
    <title>Oauth Testing Start Page</title>
</head>
<body>
<h1>Testing oauth</h1>
<p>Please click <a href="<?= $url ?>">this link</a> in order to start testing!</p>
</body>
</html>


