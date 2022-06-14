<?php
declare(strict_types=1);
class User implements JsonSerializable
{
    private String $email = 'emailpublisher1@gmail.com';

    public function setEmail(String $usermail) {
        $this->email = utf8_encode($usermail);
    }

    public function getEmail() {
        return $this->email;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}
?>