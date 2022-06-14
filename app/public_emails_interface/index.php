<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Queue of Emails</title>
    <link rel="stylesheet" href="./Mail_Listing.css">
    <link rel="stylesheet" href="./Menu_Style_Queue.css">
    <script src="./Publishing_Emails.js" type="module"></script>
    <script src="./Delete_Triggers.js" type="module"></script>
    <script src="./Publish_Triggers.js" type="module"></script>
  </head>
  <body>
    <div tabindex="0" id="smallerMenu" class="smallerMenu"><img class = "dropdown_logo" src = "./assets/logo_for_menu_gray.svg" alt="logo at phone menu size"/></div>
    <nav id="menu">
      <ul class = "left_side_menu">
        <li id="menu_closer"><img class = "logo" src = "./assets/logo_for_menu.svg" alt="logo at original size"/></li>
        <li><a href="http://localhost:1080/public/DisplayUnpublishedEmails/index?email=emailpublisher1@gmail.com"><img src="./assets/queue.svg" alt="icon for publishing queue"/><strong>Publish queue</strong></a></li>
        <li><a href="./My_Published_Emails.html"><img src="./assets/published.svg" alt="icon for published emails"/><strong>Published emails</strong></a></li>
        <li><a href="./My_Archived_Emails.html"><img src="./assets/unpublished.svg" alt="icon for emails which were published by other people and which this user can visualise"/><strong>Archived emails</strong></a></li>
        <li><img src="./assets/divider.svg" alt="menu divider (in 2 categories)"/></li>
        <li><a href="./Scholarly_Documentation.html"><img src="./assets/about.svg" alt="icon for html scholarly report"/><strong>About us</strong></a></li>
        <li><a href="./index.html"><img src="./assets/logout.svg" alt="icon for logout"/><strong>Logout</strong></a></li>
      </ul>
    </nav>
    <header>
      <p>My publish queue</p>
    </header>
    <main>
      <div class="explanation" id="explanation_delete"><p>Delete</p></div>
      <div class="explanation" id="explanation_publish"><p>Publish</p></div>
      <section class="first-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien....</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish1"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete1"/>
        </div>
      </section>
      <section class="second-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish2"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete2"/>
        </div>
      </section>
      <section class="third-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish3"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete3"/>
        </div>
      </section>
      <section class="fourth-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish4"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete4"/>
        </div>
      </section>
      <section class="fifth-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish5"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete5"/>
        </div>
      </section>
      <section class="sixth-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish6"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete6"/>
        </div>
      </section>
      <section class="seventh-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish7"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete7"/>
        </div>
      </section>
      <section class="eigth-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish8"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete8"/>
        </div>
      </section>
      <section class="nineth-email">
        <h2><a href="./Email_Template.html">Title of email</a></h2>
        <p><a href="./Email_Template.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non odio sit amet orci molestie tempor vitae non sapien...</a></p>
        <div class="icons">
          <a href="./Publish_Settings.html"><img src="./assets/publish.svg" alt="view statistics option" id="publish9"/></a>
          <img src="./assets/delete.svg" alt="delete option" id="delete9"/>
        </div>
      </section>
    </main>
    <footer>
      <a href="#"><img src="./assets/arrow.svg" alt="arrow to previous page"/></a>
      <a href="#"><img src="./assets/arrow.svg" alt="arrow to next page"/></a>
    </footer>
  </body>
</html>