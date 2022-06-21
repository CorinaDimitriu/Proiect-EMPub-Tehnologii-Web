<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Template</title>
    <link rel="stylesheet" href="../../Menu_Style_Published.css">
    <link rel="stylesheet" href="../../Email_Template.css">
    <link rel="stylesheet" href="../../Statistics.css">
    <script src="../../Email_Template.js" type="module"></script>
    <script src="../../Statistics_Template.js" type="module"></script>
    <script src="../../Statistics.js" type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
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
        $postid = $displayedEmail[0]['emailName'];
        echo "<h1>From:&nbsp;</h1>
        <p><a href=\"http://localhost:1080/public/DisplayPublishedEmails/index?noPage=1&noSections="; if(isset ($_COOKIE['number_of_mails'])) {echo $_COOKIE['number_of_mails'];} else echo '6'; echo "\">". $displayedEmail[0]['emailSender'] ."</a></p>
        </section>
          <section class=\"letter_layout\">
            <h1>Title:&nbsp;</h1>
            <p id=\"keytag\" sneeze=\"".$postid."\">" . $displayedEmail[0]['emailTitle']."</p>
          </section>
        </header>
        <div class=\"pinner\">
          <img src=\"../../assets/star_with_text.svg\" alt=\"star icon as symbol of the application (decoration purpose)\"/>
        </div>
        <main>
        <article class = \"paras\">
          <figure class=\"icons\"><a href=\"#statistics_beginning\"><img src=\"../../assets/stats_icon.svg\" id=\"stats_trigger\" alt=\"statistics visualising trigger\"/></a></figure>
          <div class=\"explanation\" id=\"explanation_stats_email\"><p>View statistics</p></div>"
        . $displayedEmail[0]['emailContent'] ."</article>";
      ?>
    <figure class="stats_divider" id="statistics_beginning">
      <img src="../../assets/stats_div.svg" alt="divider which separates the statistics from the content of the email"/>
    </figure>
    <div>
      <ul class="stats_menu">
          <li><span>Available until</span><br><p><?php $displayedEmail = json_decode($data, TRUE); echo $displayedEmail[0]['emailDuration']?></p></li>
          <li><a href = "#diagram_views_menu"><span>Number of Views</span><br><p><i>-Statistics-</i></p></a></li>
          <li><a href = "#diagram_countries_menu"><span>Visitors' Countries</span><br><p><i>-Statistics-</i></p></a></li>
          <li><span>Last viewed</span><br><p id="last_view">11/02/2022</p></li>
      </ul>
    </div>
    <p>
      Please select the type of time interval you want to display charts for:
    </p>
    <div class="diagram_menu" id="diagram_views_menu">
      <select class="stats_options" id="viewsdatascope">
        <option value="1">Hourly</option>
        <option value="2">Daily</option>
        <option value="3">Weekly</option>
        <option value="4">Monthly</option>
        <option value="5">Yearly</option>
      </select>
      <ul class="stats_download"> 
        <li><button id="dl_pdfview">PDF Download</button></li>
        <li><button id="dl_htmlview">HTML Download</button></li>
        <li><button id="dl_xmlview">XML Download</button></li>
      </ul>
    </div>
    <!--  view log format: date - IP - id_post   -->
    <canvas id="viewsovertime">     
    </canvas>
    <div class="diagram_menu" id="diagram_countries_menu">
        <select class="stats_options" id="countrydatascope">
          <option value="1">Hourly</option>
          <option value="2">Daily</option>
          <option value="3">Weekly</option>
          <option value="4">Monthly</option>
          <option value="5">Yearly</option>
        </select>
        <ul class="stats_download"> 
          <li><button id="dl_pdfcountry">PDF Download</button></li>
          <li><button id="dl_htmlcountry">HTML Download</button></li>
          <li><button id="dl_xmlcountry">XML Download</button></li>
        </ul>
    </div>
    <canvas id="viewsbycountry">
    </canvas>
    </main>
  </body>
</html>