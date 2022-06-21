<?php
// required headers
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: http://localhost:1818");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../authentication_microservice/config/core.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/BeforeValidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/ExpiredException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/SignatureInvalidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/JWT.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/Key.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
require_once '../authentication_microservice/models/User.php';

class Login extends Controller {
    public function index($email = '', $code = '')
    {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $email = $_SESSION['email'];
        $code = $_POST['code'];
        $user = new User;
        $user->setEmail($email); $user->setCode($code);
        $sql = "SELECT verification_code FROM users WHERE email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_execute($stid);
        $received_code = '';
        if(($row = oci_fetch_array($stid)) != false)
           $received_code = $row['VERIFICATION_CODE'];
        oci_close($conn);

        //!received_code este un hash!
        if(password_verify($user->getCode(), $received_code)) 
        {
            global $key, $issued_at, $expiration_time, $issuer;
            $token = array(
               "iat" => $issued_at,
               "exp" => $expiration_time,
               "iss" => $issuer,
               "data" => array(
                   "email" => $user->getEmail()
               )
            );
         
            $_SESSION['email'] = '';
            $jwt = JWT::encode($token, $key, 'HS256');
            //stocare JWT in cookie-uri
            $expiration_time = time() + 24 * 60 * 60;
            setcookie("JWT", $jwt, $expiration_time, '/');
            setcookie("JWT", $jwt, $expiration_time, 'http://localhost:1080/');
            $this->view('home/Loading',"");
        }
        else {
            $data = Array("data" => "Authentication failed due to incorrect credentials.", "back" => "localhost:1818/public/CreateUser/try_again/");
            $msg = json_encode($data);
            $this->view('home/Something_Is_Wrong',$msg);
        }
    }
}
?>