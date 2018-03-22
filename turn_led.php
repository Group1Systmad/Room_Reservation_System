<?php
    session_start();
?>
<html>
    <head>
        <title>LED Switch</title>
    </head>
    <body>
        <?php
        
        $count = $_SESSION["num"];
        ?>
        <form method="GET" action="arduino_bridge.php?value=<?php echo ($count%2==0)? 1:0;$_SESSION["num"]++;?>">
            <input type="submit" name="switch_button" value="TURN <?php echo ($count%2==0)? "OFF":"ON";?>">
        </form>
    </body>
</html>
