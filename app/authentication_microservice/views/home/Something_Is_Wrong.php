<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EMPub</title>
        <link rel="stylesheet" href="../../../Something_Is_Wrong.css">
    </head>
    <body>
        <img src="../../../assets/alert.svg" alt = "alert"/>
        <p>
            <?php
                header("Content-type: text/html; charset=UTF-8");
                $info = json_decode($data, TRUE);
                str_replace($info["back"],'\\','');
                echo $info["data"] . 
        "</p>
        <form class=\"button\" action=\"http://" . $info["back"] . "\" method=\"post\">
            <button type=\"submit\">Back</button>
        </form>"
        ?>
    </body>
</html>