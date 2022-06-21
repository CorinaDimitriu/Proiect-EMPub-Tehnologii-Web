<?php  header("Content-type: text/html; charset=UTF-8"); if(!isset($_SESSION['exists'])) {session_start(); $_SESSION['exists'] = 1;}
if($data != '')
   $_SESSION['email'] = $data;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EMPub</title>
        <link rel="stylesheet" href="../../../Login_Style.css">
    </head>
    
    <body>
        <script>
            function formatCode() {
                var code = document.getElementById('code');
                var number = /^\d+$/;
                if(!code.value ||  !number.test(code.value) || code.value.length!==4) {
                    alert("Code must contain 4 digits.");
                    return false;
                }
                return true;
            }
        </script>
        <img src="../../../assets/logo.svg" alt="Logo"/>
        <img src="../../../assets/star.svg" alt="Star"/>
        <img src="../../../assets/star-with-text.svg" alt="Star with text">

        <p>Publish your email and share it with whoever you want without having to forward it!</p>

        <form method="post" action="http://localhost:1818/public/Login/index/">
            <label for="code">Enter verification code:</label><br>
            <input type="text" id="code" name="code" required>
        <div class="button">
            <button type="submit" onclick="return formatCode()">Continue</button>
        </div>
        </form>
    </body>
</html>