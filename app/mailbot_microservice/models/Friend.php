<?php
declare(strict_types=1);
class Friend implements JsonSerializable
{
    private String $email = '';

    public function setEmail(String $usermail) {
        $this->email = $usermail;
    }

    public function getEmail() {
        return $this->email;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}
?>