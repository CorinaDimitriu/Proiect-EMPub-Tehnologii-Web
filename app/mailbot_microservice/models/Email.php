<?php
class Email implements JsonSerializable
{
    private User $from;
    private String $subject;
    private String $mailContentFile;
    private $content; //the effective content of the mail html - big String
    private $friend;

    public function setFrom(User $from) {
        $this->from = $from;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setFriend(Friend $from) {
        $this->friend = $from;
    }

    public function getFriend() {
        return $this->friend;
    }

    public function setSubject(String $subject) {
        $this->subject = $subject;
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

    public function setContent($content) {
        $this->content = $content;
    }

    public function getContent() {
        return $this->content;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return array(
            "user" => $this->from,
            "subject" => $this->subject,
            "contentFile" => $this->mailContentFile,
            "content" => $this->content,
            "friend" => $this->friend
       );
    }
}
?>