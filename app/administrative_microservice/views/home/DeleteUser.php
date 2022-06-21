<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../EditDelete_Style.css">
    </head>
    
    <body>
        <h1>Delete User</h1>
        <p>You are going to delete the user with the email <strong><?php
       echo $data;?></strong> and all the emails associated with it.</p>
       <div class="buttons">
            <div class="button">
                <button type="button" onclick="window.location.href='http://localhost:8001/public/GetUsers/index'">Cancel</button>
            </div>
            <div class="button">
                <button type="button" onclick="window.location.href='http://localhost:8001/public/DeleteUser/index?email=<?php echo $data;?>'">Confirm</button>
            </div>
        </div>
    </body>
</html>