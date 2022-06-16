<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetUnpublishedEmails extends Controller
{
    public function index ($email = '', $noPage = 1, $noSections = 4) {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe");
        $data = $this->retrieveFromDatabase($conn, $email, $noPage, $noSections);
        oci_close($conn);
        $this->view('home/index',$data);
   }

    private function retrieveFromDatabase($conn, String $email, $noPage, $noSections) {
        $searchFrom = ($noPage - 1) * $noSections;
        $sql = "SELECT count(*) FROM (SELECT * FROM (SELECT * FROM usermails WHERE user_email = :user_email AND published = 0) WHERE ROWNUM > :searchFrom)";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_email', $email);
        oci_bind_by_name($stid, ':searchFrom', $searchFrom);
        oci_execute($stid);
        $howMany = $noSections;
        if(($row = oci_fetch_array($stid)) != false) {
            if($row['COUNT(*)'] < $noSections) {
              $howMany = $row['COUNT(*)'];
            }
        }
        $mailsArray = array();
        $user = $this->model('User');
        $user->setEmail($email);
        $sql = "SELECT * FROM (SELECT subject, content_email FROM usermails WHERE user_email = :user_email AND published = 0) WHERE ROWNUM > :searchFrom INTERSECT SELECT * FROM (SELECT subject, content_email FROM usermails WHERE user_email = :user_email AND published = 0) WHERE ROWNUM < :searchTill";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_email', $email);
        oci_bind_by_name($stid, ':searchFrom', $searchFrom);
        $searchTill = $searchFrom + $howMany + 1;
        oci_bind_by_name($stid, ':searchTill', $searchTill);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid)) != false) {
           $mail = $this->model('Email');
           $mail->setSubject($row['SUBJECT']);
           $mail->setFrom($user);
           $mail->setMailContentFile($row['CONTENT_EMAIL']);
           array_push($mailsArray,$mail);
        }
        return $mailsArray;
   }
}
?>