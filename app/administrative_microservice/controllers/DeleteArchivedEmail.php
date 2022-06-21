<?php
class DeleteArchivedEmail extends Controller
{
    public function index (String $email = '', String $content = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $code = $this->deleteArchivedEmail($conn, $email, $content);
        oci_close($conn);
        $this->view('home/DeleteEmailConfirmation', array($email, $code, $content));
    }

    private function deleteArchivedEmail($conn, String $email, String $content) {
        $code = '';

        $sql = "SELECT verification_code FROM users WHERE email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":email", $email);
        oci_execute($stid);
        if(($row = oci_fetch_array($stid)) != false) {
            $code = $row['VERIFICATION_CODE'] == '' ? '-' : $row['VERIFICATION_CODE'];
        }

        $sql = "DELETE FROM friendsmails WHERE user_email =: email AND content_email = :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":email", $email);
        oci_bind_by_name($stid, ":content", $content);
        oci_execute($stid);

        return $code;
    }
}
?>