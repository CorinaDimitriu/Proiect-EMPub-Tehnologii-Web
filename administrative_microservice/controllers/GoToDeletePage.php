<?php
class GoToDeletePage extends Controller
{
    public function index (String $email = '') {
        $this->view('home/DeleteUser', $email);
    }
}
?>