<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetUnpublishedEmails extends Controller
{
    public function index ($email = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->retrieveFromDatabase($conn, $email);
        oci_close($conn);
        $this->view('home/index',$data);
   }

    private function retrieveFromDatabase($conn, String $email) {
        $mailsArray = new MailCollection;
        $user = $this->model('User');
        $user->setEmail($email);
        $sql = "SELECT subject, content_email FROM usermails WHERE user_email = :user_email AND published = 0";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_email', $email);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid)) != false) {
           $mail = $this->model('Email');
           $mail->setSubject($row['SUBJECT']);
           $mail->setFrom($user);
           $mail->setMailContentFile($row['CONTENT_EMAIL']);
           $mailsArray->add($mail);
        }
        return $mailsArray;
   }
}
?>