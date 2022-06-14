<?php
class Email implements JsonSerializable
{
    private User $from;
    private String $subject;
    private String $mailContentFile;

    public function setFrom(User $from) {
        $this->from = $from;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setSubject(String $subject) {
        $this->subject = utf8_encode($subject);
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setMailContentFile(String $mailContent) {
        $this->mailContentFile = $mailContent;
    }

    public function getMailContentFile() {
        return $this->mailContentFile;
    }

    public function jsonSerialize() {
        return array(
            "user" => $this->from,
            "subject" => $this->subject,
            "content" => $this->mailContentFile
       );
    }
}
?>