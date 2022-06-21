<?php
class DisplayPublishedEmailContent extends Controller
{
    public function index($emailName = '', $emailTitle = '', $emailSender = '') {
        $emailName = $_POST["emailName"];
        $emailTitle = $_POST["emailTitle"];
        $emailSender = $_POST["emailSender"];
        $request_as_string = "http://localhost:8181/public/GetDetailsForEmail/index?emailName=" . $emailName;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $request_as_string);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $res = curl_exec($c);
        curl_close($c);
        $data = json_decode($res, TRUE);
        $arrayMail[] = ['emailName' => $emailName, 'emailContent' => $data['emailContent'], 'emailTitle' => $emailTitle, 'emailSender' => $emailSender, 'emailDuration' => $data['emailDuration']];
        $res = json_encode($arrayMail);
        $this->view('home/Email_Template_Published', $res);
   }
}
?>