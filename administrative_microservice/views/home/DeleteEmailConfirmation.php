<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../EditDelete_Style.css">
    </head>
    
    <body>
        <p>You deleted the email with the content <a href='#'><?php
       echo $data[2];?></a>.</p>
        <div class="buttons">
            <div class="button">
                <button type="button" id="goback" onclick="window.location.href='http://localhost:8181/public/ViewUser/index?email=<?php echo $data[0];?>&code=<?php echo $data[1];?>'">Go back</button>
            </div>
        </div>
    </body>
</html>