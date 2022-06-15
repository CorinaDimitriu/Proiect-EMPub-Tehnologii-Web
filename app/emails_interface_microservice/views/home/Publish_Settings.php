<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>EMPub</title>
        <link rel="stylesheet" href="../../Publish_Style.css">
    </head>
    
    <body>
        <p>Please set up a few things before you go:</p>

        <form method="post" action="http://localhost:1080/public/PublishEmail/index?<?php
        echo "email=" . json_decode($data);?>">
            <label id="privacy">Privacy:</label><br>

            <input type="radio" id="public" name="privacy" value="Public" checked>
            <label for="public">Public</label>

            <input type="radio" id="private" name="privacy" value="Private">
            <label for="private">Private</label><br>

            <label id="duration">Set duration:</label><br>
            <input type="radio" id="no" name="duration" value="No" checked>
            <label for="no">No</label>

            <input type="radio" id="yes" name="duration" value="Yes">
            <label for="yes">Yes</label><br>

            <div class="time">
                <input type="number" name="hours" id="hours" min="00" placeholder="hours">
                <input type="number" name="minutes" id="minutes" min="00" max="59" placeholder="minutes">
                <input type="number" name="seconds" id="seconds" min="00" max="59" placeholder="seconds">
            </div>

            <div class="password">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password">
            </div>

            <div class="button">
                <button type="submit" id="publish" onclick="window.location.href='Share.html'">Publish</button><br>
            </div>
            <div class="button quit">
                <button type="submit" id="quit" onclick="window.location.href='./My_Queue_of_Emails.html'">Quit</button>
            </div>
        </form>
    </body>
</html>