<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../EditDelete_Style.css">
        <script src="../../EditMailInfo.js"></script>
    </head>
    
    <body>
        <h1>Edit mail</h1>
        <form method="post" action="">
            <label for="subject">Subject: </label>
            <input type="text" id="subject" name="subject" value="<?php echo $data[2];?>" readonly><br>

            <label for="content">Content: </label>
            <input type="text" id="content" name="content" value="<?php echo $data[3];?>" readonly><br>

            <label for="published">Published: </label>
            <input type="text" id="published" name="published" value="<?php echo $data[4];?>" required><br>

            <label for="privacy">Privacy: </label>
            <input type="text" id="privacy" name="privacy" value="<?php echo $data[5];?>" required><br>

            <label for="password">Password: </label>
            <input type="text" id="password" name="password" value="<?php echo $data[6];?>" required><br>

            <label for="duration">Duration: </label>
            <input type="text" id="duration" name="duration" value="<?php echo $data[7];?>" required><br>

            <div class="button">
                <button type="submit" formaction='http://localhost:8001/public/ViewUser/index?email=<?php echo $data[0];?>&code=<?php echo $data[1];?>'>Cancel</button>
            </div>
            <div class="button">
                <button type="submit" onclick='return verifyData()' formaction='http://localhost:8001/public/EditMailInfo/index?email=<?php echo $data[0];?>&code=<?php echo $data[1];?>&content=<?php echo $data[3];?>'>Confirm</button>
            </div>
        </form>
    </body>
</html>