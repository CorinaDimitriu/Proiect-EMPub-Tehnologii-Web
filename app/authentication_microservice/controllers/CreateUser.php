<?php
session_start();
// required headers
header("Content-Type: application/json; charset=UTF-8");
require_once '../authentication_microservice/models/User.php';

class CreateUser extends Controller {
    public function index($email = '')
    {
        $email = $_POST['email'];
        $user = new User;
        $user->setEmail($email);
        $code = '';
        for($i = 1; $i <= 4; $i++) {
            $number = rand(0,9);
            $code .= $number; 
        }
        $user->setCode($code);
        $password_hash = password_hash($code, PASSWORD_BCRYPT);

        //execute jar from php to create/update user_email + verification_code
        $command = "java -jar ../authentication_microservice/libs/Mailbot.jar " . $email . " " . $password_hash . " " . $code;
        exec($command);
        $this->view('home/Login_Code',$email);

    }

    public function try_again($email = '') {
        $email = $_SESSION['email'];
        $_SESSION['email'] = '';
        $this->view('home/Login_Code',$email);
    }
}
?>