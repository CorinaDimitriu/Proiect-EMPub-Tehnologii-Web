<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../EditDelete_Style.css">
    </head>
    
    <body>
        <p>You deleted the user with the email <strong><?php
       echo $data;?></strong>.</p>
        <div class="buttons">
            <div class="button">
                <button type="button" id="goback" onclick="window.location.href='http://localhost:8001/public/GetUsers/index'">Go back to users</button>
            </div>
        </div>
    </body>
</html>