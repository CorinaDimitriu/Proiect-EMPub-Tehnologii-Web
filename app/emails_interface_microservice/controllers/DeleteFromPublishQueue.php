<?php
class DeleteFromPublishQueue extends Controller
{
    public function index($content = '') {
        $content = $_POST['emailName'];
        $request_as_string = "http://localhost:8181/public/DeleteFromPublishQueue/index?content=".$content;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $request_as_string);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        $res = curl_exec($c);
        curl_close($c);

        $this->view('home/Loading',"http://localhost:1080/public/DisplayUnpublishedEmails/index?noPage=1&noSections=6");
    }
}
?>