<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetUnpublishedEmails extends Controller
{
    public function index ($email = '', $noPage = 1, $noSections = 6) {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe", "AL32UTF8");
        $data = $this->retrieveFromDatabase($conn, $email, $noPage, $noSections);
        oci_close($conn);
        $this->view('home/index',$data);
   }

    private function retrieveFromDatabase($conn, String $email, $noPage, $noSections) {
        $searchFrom = ($noPage - 1) * $noSections;
        $searchTill = $noPage * $noSections + 1;
        $sql = "SELECT count(*) FROM (SELECT ROWNUM rn, t.* FROM (SELECT * FROM usermails WHERE user_email = :user_email AND published = 0 ORDER BY content_email DESC) t) WHERE rn < :searchTill AND rn > :searchFrom";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_email', $email);
        oci_bind_by_name($stid, ':searchTill', $searchTill, SQLT_INT);
        oci_bind_by_name($stid, ':searchFrom', $searchFrom, SQLT_INT);
        oci_execute($stid);
        $howMany = $noSections;
        if(($row = oci_fetch_array($stid)) != false) {
            $count = $row['COUNT(*)'];
            if($count < $noSections) {
              $howMany = $count;
            }
        }
        $mailsArray = array();
        array_push($mailsArray, $noPage);
        $user = $this->model('User');
        $user->setEmail($email);
        $sql = "SELECT * FROM (SELECT ROWNUM rn, t.* FROM (SELECT * FROM usermails WHERE user_email = :user_email AND published = 0 ORDER BY content_email DESC) t) WHERE rn < :searchTill AND rn > :searchFrom";
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
           array_push($mailsArray, $mail);
        }
        return $mailsArray;
   }
}
?>