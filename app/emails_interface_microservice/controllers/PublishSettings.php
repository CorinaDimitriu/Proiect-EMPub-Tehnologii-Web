<?php
class PublishSettings extends Controller
{
    public function index($email = '') {
        $email = $_POST["emailName"];
        $data = json_encode($email);
        $this->view('home/Publish_Settings', $data);
   }
}
?>