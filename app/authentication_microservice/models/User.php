<?php
declare(strict_types=1);
class User implements JsonSerializable
{
    private String $email = 'none';
    private String $code = 'none';

    public function setEmail(String $usermail) {
        $this->email = $usermail;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setCode(String $code) {
        $this->code = $code;
    }

    public function getCode() {
        return $this->code;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return array(
            "email" => $this->email,
            "code" => $this->code
       );
    }
}
?>