<?php
class DeleteEmail extends Controller
{
    public function index (String $content = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->deleteEmail($conn, $content);
        oci_close($conn);
        array_push($data, $content);
        $this->view('home/DeleteEmailConfirmation', $data);
    }

    private function deleteEmail($conn, String $content) {
        $email = '';
        $code = '';

        $sql = "SELECT user_email FROM usermails WHERE content_email = :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":content", $content);
        oci_execute($stid);
        if(($row = oci_fetch_array($stid)) != false) {
            $email = $row['USER_EMAIL'];
        }

        $sql = "SELECT verification_code FROM users WHERE email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":email", $email);
        oci_execute($stid);
        if(($row = oci_fetch_array($stid)) != false) {
            $code = $row['VERIFICATION_CODE'] == '' ? '-' : $row['VERIFICATION_CODE'];
        }

        $sql = "DELETE FROM usermails WHERE content_email = :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":content", $content);
        oci_execute($stid);

        $sql = "DELETE FROM friendsmails WHERE content_email = :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":content", $content);
        oci_execute($stid);

        return array($email, $code);
    }
}
?>