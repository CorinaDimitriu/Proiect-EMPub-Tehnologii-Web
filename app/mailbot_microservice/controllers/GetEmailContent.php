<?php
require_once '../mailbot_microservice/models/User.php';
require_once '../mailbot_microservice/models/Email.php';
require_once '../mailbot_microservice/models/MailCollection.php';
class GetEmailContent extends Controller
{
    public function index ($emailName = '') {
        $data = $this->retrieveContent($emailName);
        $this->view('home/indexHTML',$data);
   }

   public function retrieveContent($mailContentFile) {
        $fileToRead = "../mailbot_microservice/DownloadedMails/" . $mailContentFile;
        $file = fopen($fileToRead, "r");
        $contentOfFile = fread($file, filesize($fileToRead));
        fclose($file);
        return $contentOfFile;
   }
}
?>