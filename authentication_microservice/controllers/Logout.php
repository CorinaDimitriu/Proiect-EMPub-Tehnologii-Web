<?php
class Logout extends Controller {
    public function index() {
       unset($_COOKIE["JWT"]); 
       setcookie("JWT",null,-1,'/');
       setcookie("JWT",null,-1,'http://localhost:1080/');
       $data = Array("data" => "Hope you enjoyed our website. Click the button if you want to login again.", "back" => "localhost:1818/public/StartBrowsing/index/");
       $this->view('home/Something_Is_Wrong', json_encode($data));
    }
}
?>