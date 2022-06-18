<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>EMPub</title>
        <link rel="stylesheet" href="../../Publish_Style.css">
    </head>
    
    <body>
        <p class="paragraph">Share the link with your friends:</p>
        <script>
            function copy() {
                var copyText = document.getElementById("link");
                copyText.select();
                //copyText.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.value);
                window.location.href="https://www.google.com/";
                return false;
            }
        </script>
        <form>
            <input type="text" id="link" value="Link" readonly>
            <div class="button copylink">
                <!-- <button type="submit" id="copylink" onclick="window.location.href='./My_Published_Emails.html'">Copy link</button> -->
                <button type="submit" id="copylink" onclick="return copy()">Copy link</button>
            </div>
        </form>
    </body>
</html>