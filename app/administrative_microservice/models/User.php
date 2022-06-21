<?php
declare(strict_types=1);
class User implements JsonSerializable
{
    private String $email = 'emailpublisher1@gmail.com';
    private $code = '0000';

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(String $email) {
        $this->email = utf8_encode($email);
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = utf8_encode($code);
    }

    public function jsonSerialize() {
        return array(
            "email" => $this->email,
            "code" => $this->code
        );
    }
}
?>