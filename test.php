<?php
/*
curl https://api.smooch.io/v1/init \
     -X POST \
     -d '{"device": {"id": "03f70682b7f5b21536a3674f38b3e220", "platform": "ios", "appVersion": "1.0"}, "userId": "bob@example.com"}' \
     -H 'content-type: application/json' \
     -H 'authorization: Bearer your-jwt'
  */

$parameters = array();
//$parameters = json_decode('{"device": {"id": "03f70682b7f5b21536a3674f38b3e220", "platform": "ios", "appVersion": "1.0"}, "userId": "bob@example.com"}');
$parameters = json_decode('{"device": {"id": "03f70682b7f5b21536a3674f38b3e220", "platform": "ios", "appVersion": "1.0"}, "userId": "martti123"}');
//HelloWorld jwt: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkwZjM3MjdlMTFlMjU3MDBlYjc0NjUifQ.eyJzY29wZSI6ImFwcCJ9.BRwiJ8jQnH7aWoAafHp013hu9sFTdqHdk2cThnO1-WI
$jwt = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkzNThkZjcwYTQ0NzRiMDAyYzFhY2MifQ.eyJzY29wZSI6ImFwcCJ9.x11ff8xYNljFxcW-8pXCiEarwEFUbXUz-ahg7jC2Kq4";
$handle = curl_init("https://api.smooch.io/v1/init");
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
curl_setopt($handle, CURLOPT_HTTPHEADER, 
	array("Content-Type: application/json; charset=utf-8","Authorization: Bearer ".$jwt)
);

$response = curl_exec($handle);
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
curl_close($handle);

$response = json_decode($response, true);
print_r($response);

/*
curl https://api.smooch.io/v1/appusers/c7f6e6d6c3a637261bd9656f/conversation/messages \
     -X POST \
     -d '{"text":"Just put some vinegar on it", "role": "appMaker"}' \
     -H 'content-type: application/json' \
     -H 'authorization: Bearer your-jwt'
*/

echo '<br><br>Posting a message:<br>';

$parameters = array();
$parameters = json_decode('{"text":"Hello world!", "role": "appMaker"}');
$jwt = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkzNThkZjcwYTQ0NzRiMDAyYzFhY2MifQ.eyJzY29wZSI6ImFwcCJ9.x11ff8xYNljFxcW-8pXCiEarwEFUbXUz-ahg7jC2Kq4";
$handle = curl_init("https://api.smooch.io/v1/appusers/martti123/conversation/messages");
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
curl_setopt($handle, CURLOPT_HTTPHEADER, 
	array("Content-Type: application/json; charset=utf-8","Authorization: Bearer ".$jwt)
);

$response = curl_exec($handle);
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
curl_close($handle);

$response = json_decode($response, true);
print_r($response);

/*
curl https://api.smooch.io/v1/webhooks \
     -X POST \
     -d '{"target": "http://example.com/callback"}' \
     -H 'content-type: application/json' \
     -H 'authorization: Bearer your-jwt'
*/
echo '<br><br>Creating new webhook:<br>';

$parameters = array();
$parameters = json_decode('{"target": "https://recelsamson.xyz/221972126AAECwwJ6JkBAg9HPRsd2COFc29pbmn0BuCo/smooch-hook.php"}');
$jwt = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkzNThkZjcwYTQ0NzRiMDAyYzFhY2MifQ.eyJzY29wZSI6ImFwcCJ9.x11ff8xYNljFxcW-8pXCiEarwEFUbXUz-ahg7jC2Kq4";
$handle = curl_init("https://api.smooch.io/v1/webhooks");
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
curl_setopt($handle, CURLOPT_HTTPHEADER, 
	array("Content-Type: application/json; charset=utf-8","Authorization: Bearer ".$jwt)
);

$response = curl_exec($handle);
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
curl_close($handle);

$response = json_decode($response, true);
print_r($response);