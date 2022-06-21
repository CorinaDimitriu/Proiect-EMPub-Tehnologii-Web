<?php
class AddToArchived extends Controller
{
    public function index($email = '', $content = '') {
        $email = $_POST["emailOwner"];
        $content = $_POST["emailName"];
        $sender = $_POST["emailSender"];
        if($sender !== $email) {
            $request_as_string = "http://localhost:8181/public/AddToArchived/index?email=" . $email . "&content=" . $content;
            $c = curl_init();
            $putvars = "email=" . $email . "&content=" . $content;
            curl_setopt($c, CURLOPT_URL, $request_as_string);              
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($c, CURLOPT_POST, true); 
            curl_setopt($c, CURLOPT_POSTFIELDS, $putvars);
            curl_setopt($c, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $res = curl_exec($c);
            curl_close($c);

            $this->view('home/Loading',"http://localhost:1080/public/DisplayArchivedEmails/index?noPage=1&noSections=6");
        } else {
            $data = Array("data" => "You can't add your own post to archived emails. Click the button to view it in 'Published emails' instead.", "back" => "localhost:1080/public/DisplayPublishedEmails/index?noPage=1&noSections=6");
            $this->view('home/Something_Is_Wrong',json_encode($data));
        }
    }
}
?>