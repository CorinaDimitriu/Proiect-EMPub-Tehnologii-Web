<?php
require_once '../administrative_microservice/models/User.php';
class GetUsers extends Controller
{
    public function index () {
        $conn = oci_connect("mailbot", "MAILBOT", "localhost/xe",'AL32UTF8');
        $data = $this->getUsers($conn);
        oci_close($conn);
        $this->view('home/Home', $data);
    }

    private function getUsers($conn) {
        $users = array();
        $sql = "SELECT email, verification_code FROM users";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        while(($row = oci_fetch_array($stid)) != false) {
           $user = new User();
           $user->setEmail($row['EMAIL']);
           $user->setCode($row['VERIFICATION_CODE'] == '' ? '-' : $row['VERIFICATION_CODE']);
           array_push($users, $user);
        }
        return json_encode($users);
    }
}
?>