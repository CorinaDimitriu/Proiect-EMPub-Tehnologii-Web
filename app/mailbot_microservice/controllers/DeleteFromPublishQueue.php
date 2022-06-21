<?php
class DeleteFromPublishQueue extends Controller
{
    public function index ($content = '') {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->deleteFromDatabase($conn, $content);
        oci_close($conn);
        $this->view('home/index',$data);
   }

    private function deleteFromDatabase($conn, String $content) {
        $sql = "DELETE FROM usermails WHERE content_email= :content";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':content', $content);
        oci_execute($stid);
        $result = oci_commit($conn);
        if(!$result)
            return "error";
        else return "success";
   }
}
?>