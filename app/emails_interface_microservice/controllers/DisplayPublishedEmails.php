<?php
require_once '../emails_interface_microservice/models/User.php';
require_once '../emails_interface_microservice/models/Email.php';
require_once '../emails_interface_microservice/models/MailCollection.php';
class DisplayPublishedEmails extends Controller
{
    public function index($email = '') {
        $request_as_string = "http://localhost:8181/public/GetPublishedEmails/index?email=".$email;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $request_as_string);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $res = curl_exec($c);
        curl_close($c);
        $this->view('home/index', $res);
   }
}
?>