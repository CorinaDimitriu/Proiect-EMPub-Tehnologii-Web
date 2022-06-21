<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../EnterPassword_Style.css">
    </head>
    <body>
        <?php $email = json_decode($data, TRUE);
        $ciphering = "AES-128-CTR"; $options = 0; $iv_length = openssl_cipher_iv_length($ciphering);
        $encryption = $email[0]['password'];
        $decryption_iv = '1234567891011121';
        $decryption_key = "empubEnc";
        $pass = openssl_decrypt ($encryption, $ciphering,
            $decryption_key, $options, $decryption_iv);?>
        <script type="text/javascript">
            function MyVerifyPassword() {
                var password = "<?php echo $pass;?>";
                let passwordEntered = document.getElementById('password');
                if(passwordEntered.value !== password) {
                    alert("Wrong password!");
                    return false;
                }
                return true;
            }
        </script>   
        <h1>Enter password:</h1>
        <form action="" method="post">
            <input type="password" id="password" name="password" required><br>
            <?php
                $arrayMails = json_decode($data, TRUE);
                echo "<input type=\"hidden\" name=\"emailName\" value=\"" . $arrayMails[0]['emailName'] . "\"/>" .
                "<input type=\"hidden\" name=\"emailTitle\" value=\"" . $arrayMails[0]['emailTitle'] . "\"/>" .
                "<input type=\"hidden\" name=\"emailSender\" value=\"" . $arrayMails[0]['emailSender'] . "\"/>" .
                "<input type=\"hidden\" name=\"emailOwner\" value=\"" . $arrayMails[0]['emailOwner'] . "\"/>"
            ?>
            <div class="button">
                <button id="confirm" type="submit" formaction="http://localhost:1080/public/DisplayArchivedEmailContent/free" onclick="return MyVerifyPassword()">Confirm</button>
            </div>
            <div class="button">
                <button type="button" id="goback" onclick="window.location.href='http://localhost:1080/public/DisplayArchivedEmails/index?noPage=1&noSections=6'">Go back</button>
            </div>
        </form>
    </body>
</html>