<?php
class GoToEditPage extends Controller
{
    public function index (String $email = '', String $code = '', String $subject = '', String $content = '', String $published, String $privacy, String $password, $duration) {
        $this->view('home/EditMail', array($email, $code, $subject, $content, $published, $privacy, $password, $duration));
    }
}
?>