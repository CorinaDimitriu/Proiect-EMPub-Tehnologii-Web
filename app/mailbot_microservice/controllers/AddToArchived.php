<?php
class AddToArchived extends Controller
{
    public function index ($email = '', $content = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->addToDatabase($conn, $email, $content);
        oci_close($conn);
        $this->view('home/index', $data);
   }

    private function addToDatabase($conn, String $email, String $content) {
        $sql = "INSERT INTO friendsmails VALUES (:email, :content)";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':content', $content);
        oci_execute($stid);
        $result = oci_commit($conn);
        if(!$result)
            return "error";
        else return "success";
   }
}
?>