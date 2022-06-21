<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetDetailsForEmail extends Controller
{
    public function index ($emailName = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->retrieveDetails($conn, $emailName);
        oci_close($conn);
        $this->view('home/index',$data);
   }

   private function retrieveDetails($conn, $mailContentFile) {
        $sql = "SELECT content_email, subject, user_email, privacy, password, TO_CHAR(duration,'YYYY-MM-DD HH24:MI:SS') DATE_TIME FROM usermails WHERE content_email = :content_email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':content_email', $mailContentFile);
        oci_execute($stid);
        if (($row = oci_fetch_array($stid)) != false) {
           $emailTitle = $row['SUBJECT'];
           $emailSender = $row['USER_EMAIL'];
           $emailPrivacy = $row['PRIVACY'];
           $emailPassword = $row['PASSWORD'];
           $emailDuration = $row['DATE_TIME'];
           $fileToRead = "../mailbot_microservice/DownloadedMails/" . $mailContentFile;
           $file = fopen($fileToRead, "r");
           $emailContent = fread($file, filesize($fileToRead));
           fclose($file);
        }
        $mailsArray = array('emailContent' => $emailContent, 'emailTitle' => $emailTitle, 'emailSender' => $emailSender, 'emailPrivacy' => $emailPrivacy, 'emailPassword' => $emailPassword, 'emailDuration' => $emailDuration);
        return $mailsArray;
   }
}
?>