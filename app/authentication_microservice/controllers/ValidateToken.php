<?php
// required headers
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: http://localhost:1818");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../authentication_microservice/config/core.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/BeforeValidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/ExpiredException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/SignatureInvalidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/JWT.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/Key.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class ValidateToken extends Controller {
    public function index() {
        $jwt = $_COOKIE["JWT"];
        if($jwt) {
             try {
                global $key;
                $decoded = JWT::decode($jwt, new Key($key,'HS256'));
                $this->view('home/index',array("message" => "Valid token", "data" => ($decoded->data)->email));
         
            } catch (Exception $e) {
                $this->view('home/index',array(
                    "message" => "Access denied.",
                    "error" => $e->getMessage()
                ));
            }
        } else {
            $this->view('home/index',array("message" => "Access denied."));
        }
    }
}
?>