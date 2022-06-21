<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Europe/Bucharest');
 
// variables used for jwt
global $key, $issued_at, $expiration_time, $issuer;
$key = "empub_1818_key";
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://localhost:1818/";
?>