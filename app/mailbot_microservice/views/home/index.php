<?php
 header("Content-type: application/json; charset=UTF-8");
 header('Access-Control-Allow-Origin: *');
 echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>