<?php
include_once '../authentication_microservice/config/core.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/BeforeValidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/ExpiredException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/SignatureInvalidException.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/JWT.php';
include_once '../authentication_microservice/libs/php-jwt-main/src/Key.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
class DisplayArchivedEmailContent extends Controller
{
    public function index($emailName = '', $emailTitle = '', $emailSender = '', $emailOwner = '') {
        $emailName = $_POST["emailName"];
        $emailTitle = $_POST["emailTitle"];
        $emailSender = $_POST["emailSender"];
        $emailOwner = $_POST["emailOwner"];
        $request_as_string = "http://localhost:8181/public/GetDetailsForEmail/index?emailName=" . $emailName;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $request_as_string);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $res = curl_exec($c);
        curl_close($c);
        $data = json_decode($res, TRUE);
        if($data['emailPrivacy'] === 'Public')
        {
            $arrayMail[] = ['emailName' => $emailName, 'emailContent' => $data['emailContent'], 'emailTitle' => $emailTitle, 'emailSender' => $emailSender, 'emailOwner' => $emailOwner];
            $res = json_encode($arrayMail);
            $this->view('home/Email_Template_Archived', $res);
        }
        else 
        {
            $arrayMail[] = ['emailName' => $emailName, 'emailContent' => $data['emailContent'], 'emailTitle' => $emailTitle, 'emailSender' => $emailSender, 'emailOwner' => $emailOwner, 'password' => $data['emailPassword']];
            $res = json_encode($arrayMail);
            $this->view('home/EnterPassword', $res);
        }
    }

   public function show($link = '') {
        //decodare JWT
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
            $request_as_string = "http://localhost:8181/public/GetDetailsForEmail/index?emailName=" . $link;
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $request_as_string);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type:text/html']);
            $res = curl_exec($c);
            curl_close($c);
            $data = json_decode($res, TRUE);
            if(($data['emailPrivacy'] === 'Public') || ($data['emailSender'] === $email))
            {
                $arrayMail[] = ['emailName' => $link, 'emailContent' => $data['emailContent'], 'emailTitle' => $data['emailTitle'], 'emailSender' => $data['emailSender'], 'emailOwner' => $email];
                $res = json_encode($arrayMail);
                $this->view('home/Email_Template_Archived', $res);
            }
            else 
            {
                $arrayMail[] = ['emailName' => $link, 'emailContent' => $data['emailContent'], 'emailTitle' => $data['emailTitle'], 'emailSender' => $data['emailSender'], 'emailOwner' => $email, 'password' => $data['emailPassword']];
                $res = json_encode($arrayMail);
                $this->view('home/EnterPassword', $res);
            }
        } else {
            $data = Array("data" => "Please login in order to have access to this post.", "back" => "localhost:1818/public/StartBrowsing/index/");
            $this->view('home/Something_Is_Wrong',json_encode($data));
        }
   }

    public function free($emailName = '', $emailTitle = '', $emailSender = '', $emailOwner = '') {
        $emailName = $_POST["emailName"];
        $emailTitle = $_POST["emailTitle"];
        $emailSender = $_POST["emailSender"];
        $emailOwner = $_POST["emailOwner"];
        $request_as_string = "http://localhost:8181/public/GetEmailContent/index?emailName=" . $emailName;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $request_as_string);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type:text/html']);
        $res = curl_exec($c);
        curl_close($c);
        $arrayMail[] = ['emailName' => $emailName, 'emailContent' => $res, 'emailTitle' => $emailTitle, 'emailSender' => $emailSender, 'emailOwner' => $emailOwner];
        $res = json_encode($arrayMail);
        $this->view('home/Email_Template_Archived', $res);
    }
}
?>