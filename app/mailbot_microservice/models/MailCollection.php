<?php
require_once '../mailbot_microservice/models/Email.php';
class MailCollection implements JsonSerializable
{
    private $mailCollection = array();

    public function add(Email $email) {
        array_push($this->mailCollection, $email);
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}
?>