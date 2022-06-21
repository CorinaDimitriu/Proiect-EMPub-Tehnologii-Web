<?php
include_once '../authentication_microservice/config/core.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/BeforeValidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/ExpiredException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/SignatureInvalidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/JWT.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/Key.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
class DisplayArchivedEmails extends Controller
{
    public function index ($noPage = 1, $noSections = 6) {
        $jwt = '';
        if(isset($_COOKIE["JWT"]))
          $jwt = $_COOKIE["JWT"];
        if($jwt !== '') {
            try {
               global $key;
               $decoded = JWT::decode($jwt, new Key($key,'HS256'));

            } catch (\Firebase\JWT\ExpiredException $e) {
                $data = Array("data" => "Your session has expired. Please login again.", "back" => "localhost:1818/public/StartBrowsing/index/");
                $this->view('home/Something_Is_Wrong',json_encode($data));
                return;
           }

            $email = (($decoded->data)->email);
            if($noPage == 0)
               $noPage = 1;
            $request_as_string = "http://localhost:8181/public/GetArchivedEmails/index?email=".$email."&noPage=". $noPage.'&noSections='.$noSections;
            $c = curl_init ();
            curl_setopt ($c, CURLOPT_URL, $request_as_string);              // stabilim URL-ul serviciului
            curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
            curl_setopt ($c, CURLOPT_SSL_VERIFYPEER, false); // nu verificam certificatul digital
            curl_setopt($c, CURLOPT_HTTPHEADER, [
                'Content-Type:application/json'
            ]);
            $res = curl_exec ($c);  
            curl_close ($c);
            $decodeRes = json_decode($res,TRUE);
            $this->view('home/My_Archived_Emails',$res);
       }
       else {
           $data = Array("data" => "Your session has expired. Please login again.", "back" => "localhost:1818/public/StartBrowsing/index/");
           $this->view('home/Something_Is_Wrong',json_encode($data));
       }
   }
}
?>