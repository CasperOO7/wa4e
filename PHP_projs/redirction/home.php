<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>home</title>
</head>
<body>
    <?php
    if(isset($_SESSION["suc"])){
    echo('<p style="color:green">'.$_SESSION["suc"]."</p>\n");
    unset($_SESSION["suc"]);
    }
    if(!isset($_SESSION["user"])){
        echo('<p>Please <a href="login.php">Log In</a> to start.</p>');

    }else{
        echo('
        <p>welcome '.$_SESSION["user"].' <br> this is the gang, the place where you will always find help and collaboration.</p>
       <p>Please <a href="logout.php">Log Out</a> when you are done.</p>      
        ');
    }   
    ?>
</body>
</html>