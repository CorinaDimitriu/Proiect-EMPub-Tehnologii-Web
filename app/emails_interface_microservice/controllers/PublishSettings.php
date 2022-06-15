<?php
require_once '../emails_interface_microservice/models/User.php';
require_once '../emails_interface_microservice/models/Email.php';
require_once '../emails_interface_microservice/models/MailCollection.php';
class PublishSettings extends Controller
{
    public function index($email = '') {
        $data = json_encode($email);
        $this->view('home/Publish_Settings', $data);
   }
}
?>