<?php
class DeleteUser extends Controller
{
    public function index (String $email = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $this->deleteUser($conn, $email);
        oci_close($conn);
        $this->view('home/DeleteUserConfirmation', $email);
    }

    private function deleteUser($conn, String $email) {
        $sql = "SELECT content_email FROM usermails WHERE user_email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":email", $email);
        oci_execute($stid);
        while(($row = oci_fetch_array($stid)) != false) {
            $content = $row['CONTENT_EMAIL'];
            $sql = "DELETE FROM friendsmails WHERE content_email = :content";
            $stid2 = oci_parse($conn, $sql);
            oci_bind_by_name($stid2, ":content", $content);
            oci_execute($stid2);
        }

        $sql = "DELETE FROM users WHERE email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":email", $email);
        oci_execute($stid);

        $sql = "DELETE FROM usermails WHERE user_email = :email";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ":email", $email);
        oci_execute($stid);
    }
}
?>