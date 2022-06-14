<?php
 header("Content-type: application/json; charset=UTF-8");
 header('Access-Control-Allow-Origin: *');
 print_r(json_decode($data,TRUE));
?>