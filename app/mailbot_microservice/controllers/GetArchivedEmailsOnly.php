<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetArchivedEmailsOnly extends Controller
{
    public function index ($email = '', $emailFriend = '', $noPage = 1, $noSections = 6) {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe", "AL32UTF8");
        $data = $this->retrieveFromDatabase($conn, $email, $emailFriend, $noPage, $noSections);
        oci_close($conn);
        $this->view('home/index',$data);
   }

    private function retrieveFromDatabase($conn, String $email, String $emailFriend, $noPage, $noSections) {
        $searchFrom = ($noPage - 1) * $noSections;
        $searchTill = $noPage * $noSections + 1;
        $sql = "SELECT count(*) FROM (SELECT ROWNUM rn,u_user,u_subject,u_content FROM (SELECT u.user_email u_user,u.subject u_subject,u.content_email u_content FROM friendsmails f JOIN usermails u ON f.content_email = u.content_email WHERE f.user_email = :user_email AND published = 1 AND u.user_email = :user_email_friend ORDER BY f.content_email DESC)) WHERE rn < :searchTill AND rn > :searchFrom";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_email', $email);
        oci_bind_by_name($stid, ':searchTill', $searchTill, SQLT_INT);
        oci_bind_by_name($stid, ':user_email_friend', $emailFriend);
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
        $sql = "SELECT * FROM (SELECT ROWNUM rn,f_user,u_user,u_subject,u_content FROM (SELECT f.user_email f_user, u.user_email u_user,u.subject u_subject,u.content_email u_content FROM friendsmails f JOIN usermails u ON f.content_email = u.content_email WHERE f.user_email = :user_email AND published = 1 AND u.user_email = :user_email_friend ORDER BY f.content_email DESC)) WHERE rn < :searchTill AND rn > :searchFrom";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':user_email', $email);
        oci_bind_by_name($stid, ':user_email_friend', $emailFriend);
        oci_bind_by_name($stid, ':searchFrom', $searchFrom);
        $searchTill = $searchFrom + $howMany + 1;
        oci_bind_by_name($stid, ':searchTill', $searchTill);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid)) != false) {
           $mail = $this->model('Email');
           $mail->setSubject($row['U_SUBJECT']);
           $user = $this->model('User');
           $user->setEmail($row['U_USER']);
           $mail->setFrom($user);
           $mail->setMailContentFile($row['U_CONTENT']);
           $friend = $this->model('Friend');
           $friend->setEmail($row['F_USER']);
           $mail->setFriend($friend);
           array_push($mailsArray, $mail);
        }
        return $mailsArray;
   }
}
?>