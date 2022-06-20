<?php
class EditMailInfo extends Controller
{
    public function index(String $email = '', String $code = '', String $content = '') {
        $published = $_POST['published'];
        $published = $published == 'Yes' ? 1 : 0;
        $privacy = $_POST['privacy'];
        $password = $_POST['password'];
        $duration = $_POST['duration'];

        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $this->changeInfo($conn, $content, $published, $privacy, $password, $duration);
        oci_close($conn);
        $this->view('home/EditConfirmation', array($email, $code, $content, $published, $privacy, $password, $duration));
    }

    private function changeInfo($conn, String $content, String $published, String $privacy, String $password, $duration) {
        $sql = "UPDATE usermails SET published = :published, privacy = :privacy, password = :password, duration = to_date(:duration, 'yyyy-mm-dd hh24:mi:ss') WHERE content_email = :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":published", $published);
        oci_bind_by_name($stid, ":privacy", $privacy);
        oci_bind_by_name($stid, ":password", $password);
        oci_bind_by_name($stid, ":duration", $duration);
        oci_bind_by_name($stid, ":content", $content);
        oci_execute($stid);
    }
}
?>