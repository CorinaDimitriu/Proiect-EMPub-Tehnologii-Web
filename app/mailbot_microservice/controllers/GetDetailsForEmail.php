<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetDetailsForEmail extends Controller
{
    public function index ($emailName = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->retrieveFromDatabase($conn, $emailName);
        oci_close($conn);
        $this->view('home/index',$data);
   }

   private function retrieveDetails($mailContentFile) {
        $mailsArray = array();
        $sql = "SELECT subject, user_email FROM usermails WHERE content_email = :content_email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':content_email', $mailContentFile);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid)) != false) {
           array_push($mailsArray,$row['SUBJECT']);
           array_push($mailsArray,$row['USER_EMAIL']);
        }
        return $mailsArray;
   }
}
?>