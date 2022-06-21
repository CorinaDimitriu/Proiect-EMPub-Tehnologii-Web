<?php
class GetEmailContent extends Controller
{
    public function index ($emailName = '') {
        $data = $this->retrieveContent($emailName);
        $this->view('home/ViewEmailContent', $data);
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