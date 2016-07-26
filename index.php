<?php
/*
curl https://api.smooch.io/v1/init \
     -X POST \
     -d '{"device": {"id": "03f70682b7f5b21536a3674f38b3e220", "platform": "ios", "appVersion": "1.0"}, "userId": "bob@example.com"}' \
     -H 'content-type: application/json' \
     -H 'authorization: Bearer your-jwt'
  */

$handle = curl_init("https://api.smooch.io/v1/init");
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
curl_setopt($handle, CURLOPT_HTTPHEADER, 
    array("Content-Type: application/json; charset=utf-8","Authorization: Bearer "."eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkwZjM3MjdlMTFlMjU3MDBlYjc0NjUifQ.eyJzY29wZSI6ImFwcCJ9.WgGOskMN-YluwXzN0hFK4EIaH2M18NaM9EZ2zjTmBEo")
);

$response = curl_exec($handle);
$response = json_decode($response, true);

print_r($response);
