<?php
session_start();
if(isset($_POST["user"])&&isset($_POST["pass"])){
    unset($_SESSION["user"]);
    if($_POST["pass"]=="casper"){
        $_SESSION["user"]=$_POST["user"];
        $_SESSION["suc"]="success! welcome to the gang \n";
        header("Location: ./home.php");
        return;
    }
        else{
            $_SESSION["err"]="wrong pass \n";
            header("Location: ./login.php");
            return;
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>  
<title>login</title>
</head>
<body>
    <h1>login</h1>
    <?php
    if(isset($_SESSION["err"])){
        echo('<p style="color:red">'.$_SESSION["err"]."</p>\n");
        unset($_SESSION["err"]);
    } 
    ?>
    <form method="post">
<p>Account: <input type="text" name="user" value=""></p>
<p>Password: <input type="text" name="pass" value=""></p>
<p><input type="submit" value="Log In">
<a href="home.php">Cancel</a></p>
</form>
</body>
</html>