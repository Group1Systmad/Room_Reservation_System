<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
    </head>
    <body>
        <form class="form_container" action="verifylogin.php" method="post">
            <table>
                <tr>
                    <td> Username: </td>
                    <td> <input type="text" name="uname" placeholder="Username"> </td>
                </tr>
                <tr>
                    <td> Old Password: </td>
                    <td> <input type="password" name="opword" placeholder="Old Password" required="true"> </td>
                </tr>
                <tr>
                    <td> New Password: </td>
                    <td> <input type="password" name="npword" placeholder="New Password" required="true"> </td>
                </tr>
                <tr>
                    <td> Confirm New Password: </td>
                    <td> <input type="password" name="npword" placeholder="New Password" required="true"> </td>
                </tr>
            </table>
            <input type="submit" class="input-child button-input" name="button_login" value="Confirm">
        </form>
    </body>
</html>
