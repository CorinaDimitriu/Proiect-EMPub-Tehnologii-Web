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

        <form method="post" action="">
            <input type="hidden" name="email" value=<?php echo json_decode($data);?>>
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

            <script>
            function validate() {
                let public = document.getElementById("public");
                if (public.checked) return true;

                let password = document.querySelector("#password");

                let upperCaseLetters = /[A-Z]/g;
                let numbers = /[0-9]/g;
                let specialCharacters = /[^A-Za-z 0-9]/g;

                var message = "";
                if (password === "" || password.value.length < 4)
                    message = message.concat("Password must be at leat 4 characters long. ");
                if (!password.value.match(upperCaseLetters))
                    message = message.concat("Password must contain at least one uppercase letter. ");
                if (!password.value.match(numbers))
                    message = message.concat("Password must contain at least one number. ");
                if (!password.value.match(specialCharacters))
                    message = message.concat("Password must contain at least one special character. ");
                if (message !== "") {
                    alert(message);
                    return false;
                }
                return true; 
            }
            </script>

            <div class="button">
                <button type="submit" id="publish" 
                formaction="http://localhost:1080/public/PublishEmail/index/" 
                onclick="return validate()">Publish</button><br>
            </div>
            <div class="button quit">
                <button type="submit" id="quit" formaction="http://localhost:1080/public/DisplayUnpublishedEmails/index?noPage=1&noSections=6">Quit</button>
            </div>
        </form>
    </body>
</html>