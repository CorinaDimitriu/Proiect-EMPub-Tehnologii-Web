<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../EditDelete_Style.css">
    </head>
    
    <body>
        <h1>You edited the info for <strong><?php
       echo $data[2];?></strong>:</h1>
        <p><strong>Published</strong>: <?php echo $data[3] == 1 ? 'Yes' : 'No';?></p>
        <p><strong>Privacy</strong>: <?php echo $data[4]?></p>
        <p><strong>Password</strong>: <?php echo $data[5]?></p>
        <p><strong>Duration</strong>: <?php echo $data[6]?></p>
        <div class="buttons">
            <div class="button">
                <button type="button" id="goback" onclick="window.location.href='http://localhost:8001/public/ViewUser/index?email=<?php echo $data[0];?>&code=<?php echo $data[1];?>'">Go back to users</button>
            </div>
        </div>
    </body>
</html>