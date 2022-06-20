<?php
require_once '../administrative_microservice/models/Email.php';
class ViewUser extends Controller
{
    public function index ($email = '', $code = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data1 = $this->getOwnEmails($conn, $email);
        $data2 = $this->getFriendsEmails($conn, $email);
        oci_close($conn);
        $this->view('home/ViewUserInfo', json_encode(array($email, $code, $data1, $data2)));
    }

    public function getOwnEmails($conn, $email) {
        $emails = array();
        $sql = "SELECT subject, content_email, published, privacy, password, to_char(duration, 'yyyy-mm-dd hh24:mi:ss') as time FROM usermails WHERE user_email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_execute($stid);
        while(($row = oci_fetch_array($stid)) != false) {
           $email = new Email();
           $email->setSubject($row['SUBJECT']);
           $email->setMailContentFile($row['CONTENT_EMAIL']);
           $email->setPublished($row['PUBLISHED'] == 0 ? "No" : "Yes");
           $email->setPrivacy($row['PRIVACY']);
           $email->setPassword($row['PASSWORD'] === '' ? "none" : $row['PASSWORD']);
           $email->setDuration($row['TIME']);
           array_push($emails, $email);
        }
        return $emails;
    }

    public function getFriendsEmails($conn, $email) {
        $emails = array();
        $sql = "SELECT subject, content_email FROM friendsmails WHERE user_email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_execute($stid);
        while(($row = oci_fetch_array($stid)) != false) {
           $email = new Email();
           $email->setSubject($row['SUBJECT']);
           $email->setMailContentFile($row['CONTENT_EMAIL']);
           array_push($emails, $email);
        }
        return $emails;
    }
}
?>