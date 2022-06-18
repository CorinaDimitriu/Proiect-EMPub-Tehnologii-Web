<?php
require_once '../emails_interface_microservice/models/User.php';
require_once '../emails_interface_microservice/models/Email.php';
class AddToArchived extends Controller
{
    public function index($email = '', $subject = '', $content = '') {
        $request_as_string = "http://localhost:8181/public/AddToArchived/index?email=" . $email . "&subject=". $subject . "&content=" . $content;
        $c = curl_init();
        $putvars = "email=" . $email . "&subject=". $subject . "&content=" . $content;
        curl_setopt($c, CURLOPT_URL, $request_as_string);              
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($c, CURLOPT_POST, true); 
        curl_setopt($c, CURLOPT_POSTFIELDS, $putvars);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $res = curl_exec($c);
        curl_close($c);
        $this->view('home/index', $res);
    }
}
?>