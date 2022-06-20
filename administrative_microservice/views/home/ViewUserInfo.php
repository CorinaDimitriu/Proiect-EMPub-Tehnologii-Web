<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../ViewUserInfo_Style.css">
        <!-- <script src="../../EditUserInfo.js"></script> -->
    </head>
    <body>
        <div class="button">
            <button type="submit" id="users" onclick="window.location.href='http://localhost:8181/public/GetUsers/index'">Users</button>
        </div>
        <div class="button" id="logoutBtn">
            <button type="submit" id="logout" onclick="window.location.href='#'">Logout</button>
        </div>

        <form action="">
            <label for="name">Email</label><br>
            <input type="text" id="name" name="name" value="<?php 
                    $dataArray = json_decode($data);
                    echo $dataArray[0];?>" readonly><br>

            <label for="code">Verification code</label><br>
            <input type="text" id="code" name="code" value="<?php 
                    $dataArray = json_decode($data);
                    echo $dataArray[1];?>" readonly><br>
        </form> 

        <div class="own">
            <table>
                <tr id="header">
                    <th>Subject</th>
                    <th>Content</th>
                    <th>Published</th>
                    <th>Privacy</th>
                    <th>Password</th>
                    <th>Duration</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    $dataArray = json_decode($data);
                    for($i = 0; $i < sizeof($dataArray[2]); $i++)
                        echo "<tr>". 
                        "<td>" . $dataArray[2][$i]->{'subject'} . "</td>".
                        "<td><a href='#' target='_blank'>" . $dataArray[2][$i]->{'content'} . "</a></td>" . 
                        "<td>" . $dataArray[2][$i]->{'published'} . "</td>" . 
                        "<td>" . $dataArray[2][$i]->{'privacy'} . "</td>" . 
                        "<td>" . $dataArray[2][$i]->{'password'} . "</td>" . 
                        "<td>" . $dataArray[2][$i]->{'duration'} . "</td>" . 
                        "<td><button type='submit' id='edit' onclick=\"window.location.href='http://localhost:8181/public/GoToEditPage/index?email=" . $dataArray[0] . 
                        "&code=" . $dataArray[1] . 
                        "&subject=" . $dataArray[2][$i]->{'subject'} . 
                        "&content=" . $dataArray[2][$i]->{'content'} .
                        "&published=" . $dataArray[2][$i]->{'published'} .
                        "&privacy=" . $dataArray[2][$i]->{'privacy'} .
                        "&password=" . $dataArray[2][$i]->{'password'} . 
                        "&duration=" . $dataArray[2][$i]->{'duration'}. "'\">Edit</button></td>" . 
                        "<td><button type='submit' id='delete' onclick=\"window.location.href='http://localhost:8181/public/DeleteEmail/index?content=" . $dataArray[2][$i]->{'content'} . "'\">Delete</button></td> </tr>"; 
                ?>
            </table>
        </div>

        <div class="archived">
            <table>
                <tr id="header">
                    <th>Subject</th>
                    <th>Content</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    $dataArray = json_decode($data);
                    for($i = 0; $i < sizeof($dataArray[3]); $i++)
                        echo "<tr>". 
                        "<td>" . $dataArray[3][$i]->{'subject'} . "</td>".
                        "<td><a href='#' target='_blank'>" . $dataArray[3][$i]->{'content'} . "</a></td>" .  
                        "<td><button type='submit' id='delete' onclick=\"window.location.href='http://localhost:8181/public/DeleteArchivedEmail/index?email=" . $dataArray[0] ."&content=" . $dataArray[3][$i]->{'content'} . "'\">Delete</button></td> </tr>"; 
                ?>
            </table>
        </div>
    </body>
</html>