<?php
require_once '../emails_interface_microservice/models/User.php';
require_once '../emails_interface_microservice/models/Email.php';
require_once '../emails_interface_microservice/models/MailCollection.php';
class SendRequest extends Controller
{
    public function index ($email = '') {
        $request_as_string = "http://localhost:1080/public/GetUnpublishedEmails/index?email=".$email;
        $c = curl_init ();
        curl_setopt ($c, CURLOPT_URL, $request_as_string);              // stabilim URL-ul serviciului
        curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
        curl_setopt ($c, CURLOPT_SSL_VERIFYPEER, false); // nu verificam certificatul digital
        curl_setopt($c, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json'
        ]);
        $res = curl_exec ($c);                           // executam cererea GET
        curl_close ($c);
        $this->view('home/index',$res);
   }
}
?>