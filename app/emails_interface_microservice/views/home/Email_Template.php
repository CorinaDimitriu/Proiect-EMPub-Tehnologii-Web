<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Template</title>
    <link rel="stylesheet" href="../../Menu_Style_Queue.css">
    <link rel="stylesheet" href="../../Email_Template.css">
    <link rel="stylesheet" href="../../Statistics.css">
    <script src="../../Email_Template.js" type="module"></script>
    <script src="../../Publish_Template.js" type="module"></script>
    <script src="../../Statistics_Template.js" type="module"></script>
    <script src="../../Statistics.js" type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  </head>
  <body>
    <div tabindex="0" id="smallerMenu" class="smallerMenu"><img class = "dropdown_logo" src = "../../assets/logo_for_menu_gray.svg" alt="logo at phone menu size"/></div>
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
     <section class="letter_layout">
     <?php
        $displayedEmail = json_decode($data, TRUE);
        if(strlen($displayedEmail[0]['emailTitle']) > 25) {
          $displayedEmail[0]['emailTitle'] = substr($displayedEmail[0]['emailTitle'], 0, 25) . '...';
        }
        header('Content-Type: text/html; charset=utf-8');
        echo "<h1>From:&nbsp;</h1>
        <p><a href=\"http://localhost:1080/public/DisplayUnpublishedEmails/index?noPage=1&noSections="; if(isset ($_COOKIE['number_of_mails'])) {echo $_COOKIE['number_of_mails'];} else echo '6'; echo "\">". $displayedEmail[0]['emailSender'] ."</a></p>
        </section>
          <section class=\"letter_layout\">
            <h1>Title:&nbsp;</h1>
            <p>" . $displayedEmail[0]['emailTitle']."</p>
          </section>
        </header>
        <div class=\"pinner\">
          <img src=\"../../assets/star_with_text.svg\" alt=\"star icon as symbol of the application (decoration purpose)\"/>
        </div>
        <main>
        <article class = \"paras\">
          <figure class=\"icons\">
          <form id=\"emailFormPublish\" action=\"http://localhost:1080/public/PublishSettings/index\" method=\"post\">".
          "<a href=\"javascript:;\" onclick=\"document.getElementById('emailFormPublish').submit();"."\">"; echo "<img src=\"../../assets/publish.svg\" id=\"publish_trigger\" alt=\"publishing trigger\"/></a>".
          "<input type=\"hidden\" name=\"emailName\" value=\"" . $displayedEmail[0]['emailName'] . "\"/>" .
          "</form>";
          echo "</figure>
          <div class=\"explanation\" id=\"explanation_publish_email\"><p>Publish</p></div>"
        . $displayedEmail[0]['emailContent'] ."</article>";
      ?>
    </main>
  </body>
</html>