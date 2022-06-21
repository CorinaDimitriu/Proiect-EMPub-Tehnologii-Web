<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class PublishEmail extends Controller
{
    public function index($email = '', $privacy = '', $hours = '0', $minutes = '0', $seconds = '0',  $password = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');

        date_default_timezone_set('Europe/Bucharest');
        $date = date("h:i:sa");
        if($hours !== "vid")
            $date = date('Y-m-d H:i:s', strtotime($date. ' + ' . $hours . ' hours'));
        if($minutes !== "vid")
            $date = date('Y-m-d H:i:s', strtotime($date. ' + ' . $minutes . ' minutes'));
        if($seconds !== "vid")
            $date = date('Y-m-d H:i:s', strtotime($date. ' + ' . $seconds . ' seconds'));
        if($hours === "vid" && $minutes === "vid" && $seconds === "vid")
            $date = date('Y-m-d H:i:s', strtotime($date. ' + 10 years'));

        $data = $this->publish($conn, $email, $privacy, $password, $date);
        oci_close($conn);
        $this->view('home/index', $data);
    }

    private function publish($conn, String $email, String $privacy, String $password, $duration) {
        $sql = "UPDATE usermails SET published = 1, privacy = :privacy, password = :password, duration = to_date(:duration, 'yyyy-mm-dd hh24:mi:ss') WHERE content_email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':privacy', $privacy);
        $encryption = '';
        if($password === "none")
            $password = "";
        else {
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "empubEnc";
            $encryption = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
        }
        oci_bind_by_name($stid, ':password', $encryption);
        oci_bind_by_name($stid, ':duration', $duration);
        oci_execute($stid);
        $result = oci_commit($conn);
        if(!$result)
            return "error";
        else return "success";
    }
}
?>