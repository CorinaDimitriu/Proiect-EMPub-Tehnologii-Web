<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
class DeleteFromPublished extends Controller
{
    public function index ($content = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->deleteFromDatabase($conn, $content);
        oci_close($conn);
        $this->view('home/index', $data);
   }

    private function deleteFromDatabase($conn, String $content) {
        $sql = "DELETE FROM usermails WHERE content_email= :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':content', $content);
        oci_execute($stid);
        $result1 = oci_commit($conn);

        $sql = "DELETE FROM friendsmails WHERE content_email= :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':content', $content);
        oci_execute($stid);
        $result2 = oci_commit($conn);

        if(!$result1 || !$result2)
            return "error";
        else return "success";
   }
}
?>