<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Published Emails</title>
    <link rel="stylesheet" href="../../Mail_Listing.css">
    <link rel="stylesheet" href="../../Menu_Style_Published.css">
    <script src="../../Publishing_Emails.js" type="module"></script>
    <script src="../../Delete_Triggers.js" type="module"></script>
    <script src="../../Statistics_Triggers.js" type="module"></script>
    <script src="../../Count_Emails.js" type="module"></script>
  </head>
  <body>
    <div tabindex="0" id="smallerMenu" class="smallerMenu"><img class = "dropdown_logo" src = "./assets/logo_for_menu_gray.svg" alt="logo at phone menu size"/></div>
    <nav id="menu">
      <ul class = "left_side_menu">
        <li id="menu_closer"><img class = "logo" src = "../../assets/logo_for_menu.svg" alt="logo at original size"/></li>
        <li><a href="http://localhost:1080/public/DisplayUnpublishedEmails/index?noPage=1&noSections=<?php if(isset ($_COOKIE['number_of_mails'])) {echo $_COOKIE['number_of_mails'];} else echo '6';?>">
        <img src="../../assets/queue.svg" alt="icon for publishing queue"/><strong>Publish queue</strong></a></li>
        <li><a href="http://localhost:1080/public/DisplayPublishedEmails/index?noPage=1&noSections=<?php if(isset ($_COOKIE['number_of_mails'])) {echo $_COOKIE['number_of_mails'];} else echo '6';?>">
        <img src="../../assets/published.svg" alt="icon for published emails"/><strong>Published emails</strong></a></li>
        <li><a href="http://localhost:1080/public/DisplayArchivedEmails/index?noPage=1&noSections=<?php if(isset ($_COOKIE['number_of_mails'])) {echo $_COOKIE['number_of_mails'];} else echo '6';?>">
        <img src="../../assets/unpublished.svg" alt="icon for emails which were published by other people and which this user can visualise"/><strong>Archived emails</strong></a></li>
        <li><img src="../../assets/divider.svg" alt="menu divider (in 2 categories)"/></li>
        <li><a href="../../Scholarly_Documentation.html"><img src="../../assets/about.svg" alt="icon for html scholarly report"/><strong>About us</strong></a></li>
        <li><a href="http://localhost:1818/public/Logout/index"><img src="../../assets/logout.svg" alt="icon for logout"/><strong>Logout</strong></a></li>
      </ul>
    </nav>
    <header>
      <p>My published emails</p>
    </header>
    <main>
      <div class="explanation" id="explanation_delete"><p>Delete</p></div>
      <div class="explanation" id="explanation_stats"><p>View statistics</p></div>
      <?php
        header('Content-Type: text/html; charset=utf-8');
        if(isset ($_COOKIE['number_of_mails'])) 
          $noSections = $_COOKIE['number_of_mails'];
        else $noSections = 6;
        $arrayMails = json_decode($data, TRUE);
        if(sizeof($arrayMails) > 1) {
        $mini = sizeof($arrayMails) - 1;
        if($noSections < $mini)
        $mini = $noSections;
        for($i = 1; $i <= $mini; $i++) {
            echo "<section class=";
            switch($i) {
                case 1: echo "\"first-email\">"; break;
                case 2: echo "\"second-email\">"; break;
                case 3: echo "\"third-email\">"; break;
                case 4: echo "\"fourth-email\">"; break;
                case 5: echo "\"fifth-email\">"; break;
                case 6: echo "\"sixth-email\">"; break;
                case 7: echo "\"seventh-email\">"; break;
                case 8: echo "\"eigth-email\">"; break;
                case 9: echo "\"nineth-email\">"; break;
            }
            $title = $arrayMails[$i]["subject"];
            if(strlen($title) > 20) {
                $title = substr($title, 0, 20) . '...';
            }
            echo "<h2><form id=\"emailFormTitle". ($i)."\""." action=\"http://localhost:1080/public/DisplayPublishedEmailContent/index\"" . " method=\"post\">".
            "<p><a href=\"javascript:;\" onclick=\"document.getElementById('emailFormTitle" . ($i) . "').submit();"."\">"; /*echo substr(ltrim($digest->text), 0, 50);*/ echo $title . "</a></p>".
            "<input type=\"hidden\" name=\"emailName\" value=\"" . $arrayMails[$i]['contentFile'] . "\"/>" .
            "<input type=\"hidden\" name=\"emailTitle\" value=\"" . $arrayMails[$i]['subject'] . "\"/>" .
            "<input type=\"hidden\" name=\"emailSender\" value=\"" . $arrayMails[$i]['user']['email'] . "\"/>" .
            "</form></h2>";
            
            /*$request_as_string = "https://extractorapi.com/api/v1/extractor/?apikey=8a9fa86f24a4577a8f7d297fa1cfdd2a9f0bcef6&url=".'https://0622-2a02-2f0e-5614-a000-f852-bb83-de1c-ddc.eu.ngrok.io/public/GetEmailContent/index?emailName='.$arrayMails[$i]["contentFile"];
            $c = curl_init ();
            curl_setopt ($c, CURLOPT_URL, $request_as_string);              // stabilim URL-ul serviciului
            curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
            curl_setopt ($c, CURLOPT_SSL_VERIFYPEER, false); // nu verificam certificatul digital
            curl_setopt($c, CURLOPT_HTTPHEADER, [
                'Content-Type:application/json'
            ]);
            $res = curl_exec ($c);
            $digestArray = json_decode($res, TRUE);
            while(!isset($digestArray['text'])) {
              $res = curl_exec ($c);
              $digestArray = json_decode($res, TRUE);
            }  
            $digest = json_decode($res);               
            curl_close ($c);*/
            echo "<form id=\"emailFormPreview". ($i)."\""." action=\"http://localhost:1080/public/DisplayPublishedEmailContent/index\"" . " method=\"post\">".
            "<p><a href=\"javascript:;\" onclick=\"document.getElementById('emailFormPreview" . ($i) . "').submit();"."\">"; /*echo substr(ltrim($digest->text), 0, 50);*/ echo "...<br>Click to view full content of email...</a></p>".
            "<input type=\"hidden\" name=\"emailName\" value=\"" . $arrayMails[$i]['contentFile'] . "\"/>" .
            "<input type=\"hidden\" name=\"emailTitle\" value=\"" . $arrayMails[$i]['subject'] . "\"/>" .
            "<input type=\"hidden\" name=\"emailSender\" value=\"" . $arrayMails[$i]['user']['email'] . "\"/>" .
            "</form>";
            echo "<div class=\"icons\">
            <img src=\"../../assets/stats_icon.svg\" alt=\"view statistics option\" id=\"stats" .($i)."\"/>";
            echo "<form id=\"emailFormDelete". ($i)."\""." action=\"http://localhost:1080/public/DeleteFromPublished/index\"" . " method=\"post\">".
            "<a href=\"javascript:;\" onclick=\"document.getElementById('emailFormDelete" . ($i) . "').submit();"."\">"; echo "<img src=\"../../assets/delete.svg\" alt=\"delete option\" id=\"delete".($i)."\"/></a>".
            "<input type=\"hidden\" name=\"emailName\" value=\"" . $arrayMails[$i]['contentFile'] . "\"/>" .
            "</form>";
            echo "</div></section>";
          }
        }
    $next = $arrayMails[0] + 1;
    if(sizeof($arrayMails) === 1) {
      $next = $arrayMails[0];
    }
    echo "</main>
    <footer>
      <a href=\"http://localhost:1080/public/DisplayPublishedEmails/index?noPage=". $arrayMails[0] - 1 . "&noSections=" . $_COOKIE["number_of_mails"] ."\"><img src=\"../../assets/arrow.svg\" alt=\"arrow to previous page\"/></a>
      <a href=\"http://localhost:1080/public/DisplayPublishedEmails/index?noPage=". $next . "&noSections=" . $_COOKIE["number_of_mails"]."\"><img src=\"../../assets/arrow.svg\" alt=\"arrow to next page\"/></a>
    </footer>"
    ?>
  </body>
</html>