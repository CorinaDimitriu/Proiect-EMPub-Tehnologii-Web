<?php
class PublishEmail extends Controller
{
    public function index($email = '', $privacy = '', $duration = '', $hours = '0', $minutes = '0', $seconds = '0', $password = '') {
        $email = $_POST['email'];
        $privacy = $_POST['privacy'];
        $duration = $_POST['duration'];
        $hours = $_POST['hours'];
        $minutes = $_POST['minutes'];
        $seconds = $_POST['seconds'];
        $password = $_POST['password'];

        if($hours === '')
            $hours = "vid";
        if($minutes === '')
            $minutes = "vid";
        if($seconds === '')
            $seconds = "vid";
        if($password === '')
            $password = "none";
        
        $request_as_string = "http://localhost:8181/public/PublishEmail/index?email=" . $email . "&privacy=" . $privacy . "&hours=" . $hours . "&minutes=" . $minutes ."&seconds=" . $seconds . "&password=" . $password;
        $c = curl_init();
        //str_replace(" ", "%20", $request_as_string);
        $postvars = $email . "&privacy=" . $privacy . "&hours=" . $hours . "&minutes=" . $minutes ."&seconds=" . $seconds . "&password=" . $password;
        curl_setopt($c, CURLOPT_URL, $request_as_string);              
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($c, CURLOPT_POST, 1); 
        curl_setopt($c, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $res = curl_exec($c);
        curl_close($c);
        $this->view('home/Share', $email);
   }
}
?>