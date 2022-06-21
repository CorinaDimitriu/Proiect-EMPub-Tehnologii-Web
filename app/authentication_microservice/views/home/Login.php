<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>EMPub</title>
        <link rel="stylesheet" href="../../../Login_Style.css">
    </head>
    
    <body>
        <script>
            function formatEmail() {
                var emailFormat = /^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/;
                var email = document.getElementById('email').value;
                if(email === '' || !emailFormat.test(email)) {
                    alert("The email entered does not match the correct format.");
                    return false;
                }
                return true;
            }
        </script>
        <a href="../../../Scholarly_Documentation.html"><img src="../../../assets/about.svg" alt="About"></a>
        <img src="../../../assets/logo.svg" alt="Logo"/>
        <img src="../../../assets/star.svg" alt="Star"/>
        <img src="../../../assets/star-with-text.svg" alt="Star with text">

        <p>Publish your email and share it with whoever you want without having to forward it!</p>

        <form method="post" action="http://localhost:1818/public/CreateUser/index/">
            <label for="email">Enter your email:</label><br>
            <input type="email" id="email" name="email" required>
        <div class="button">
            <button type="submit" onclick="return formatEmail()">Continue</button>
        </div>
        </form>
    </body>
</html>