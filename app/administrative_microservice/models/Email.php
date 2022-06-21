<?php
class Email implements JsonSerializable
{
    //private User $from;
    private String $subject = '';
    private String $mailContentFile = '';
    private String $published = '';
    private String $privacy = '';
    private String $password = '';
    private String $duration = '';

    // public function setFrom(User $from) {
    //     $this->from = $from;
    // }

    // public function getFrom() {
    //     return $this->from;
    // }

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

    public function setPublished(String $published) {
        $this->published = $published;
    }

    public function getPublished() {
        return $this->published;
    }

    public function setPrivacy(String $privacy) {
        $this->privacy = $privacy;
    }

    public function getPrivacy() {
        return $this->privacy;
    }

    public function setPassword(String $password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setDuration(String $duration) {
        $this->duration = $duration;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function jsonSerialize() {
        return array(
            //"user" => $this->from,
            "subject" => $this->subject,
            "content" => $this->mailContentFile,
            "published" => $this->published,
            "privacy" => $this->privacy,
            "password" => $this->password,
            "duration" => $this->duration
       );
    }
}
?>