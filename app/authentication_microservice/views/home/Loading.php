<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EMPub</title>
        <link rel="stylesheet" href="../../../Something_Is_Wrong.css">
    </head>
    <body>
    <script type="text/javascript">
       document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById("submit").click();
    });
    </script>
        <p>
           Loading...
        </p>
        <form class="button" action="http://localhost:1080/public/DisplayUnpublishedEmails/index?noPage=1&noSections=6" method="get">
            <button type="submit" id="submit">Redirecting...</button>
        </form>
    </body>
</html>