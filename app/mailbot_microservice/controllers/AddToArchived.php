<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
class AddToArchived extends Controller
{
    public function index ($email = '', $subject = '', $content = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->addToDatabase($conn, $email, $subject, $content);
        oci_close($conn);
        $this->view('home/index', $data);
   }

    private function addToDatabase($conn, String $email, String $subject, String $content) {
        $sql = "INSERT INTO friendsmails VALUES (:email, :subject, :content)";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':subject', $subject);
        oci_bind_by_name($stid, ':content', $content);
        oci_execute($stid);
        $result = oci_commit($conn);
        if(!$result)
            return "error";
        else return "success";
   }
}
?>