<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="../../Home_Style.css">
    </head>
    <body>
        <div class="button">
            <button type="submit" id="users" onclick="window.location.href='http://localhost:8181/public/GetUsers/index'">Users</button>
        </div>
        <div class="table">
            <table>
                <tr id="header">
                    <th>Email</th>
                    <th>Verification code</th>
                    <th>View info</th>
                    <th>Delete</th>
                </tr>
                <?php 
                    $dataArray = json_decode($data);
                    for($i = 0; $i < sizeof($dataArray); $i++)
                        echo "<tr><td>" . $dataArray[$i]->{'email'} . "</td><td>" . $dataArray[$i]->{'code'} . "</td>" . 
                        "<td><button type='submit' id='view' onclick=\"window.location.href='http://localhost:8181/public/ViewUser/index?email=" . $dataArray[$i]->{'email'} . "&code=" . $dataArray[$i]->{'code'} . "'\">View info</button></td>" . 
                        "<td><button type='submit' id='delete' onclick=\"window.location.href='http://localhost:8181/public/GoToDeletePage/index?email=" . $dataArray[$i]->{'email'} ."'\">Delete</button></td> </tr>"; 
                ?>
            </table>
        </div>
    </body>
</html>