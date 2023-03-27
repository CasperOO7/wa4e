<?php
require_once "pdo_con.php";
session_start();
$salt='XyZzy12*_';
if(isset($_SESSION['name']))                        //if theres already user unset him
unset($_SESSION['name']);
if(isset($_POST['email']) && isset($_POST['pass'])){
if(strlen($_POST['email']) <1 || strlen($_POST['pass']) <1)       /*{checks if theres login data and do process on it to make sure its on shape */
    {
        $_SESSION['fail'] = " pass and email are required";
        header("Location: ./login.php");
        return;
    }
    if(strstr($_POST['email'],'@')===false){
        $_SESSION['fail'] = "unvalid email";
    header("Location: ./login.php");
    return;
    } 
    else
    {
        $check = hash('md5', $salt.$_POST['pass']);
        $stmt = $pdo->prepare('SELECT user_id, name FROM users
            WHERE email = :em AND password = :pw');
        $stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( $row !== false ) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];
            // Redirect the browser to index.php
            header("Location: index.php");
            return;
        }
        else{
        $_SESSION['fail'] = "Incorrect password";
        error_log("Login fail ".$_POST['email']." $check");                //redircts to the same page aka.POST->redirect->GET technique
        header("Location: ./login.php");
        return;
        }

    }
}
?>
<?php  
    if ( isset($_SESSION['fail']) && $_SESSION['fail'] !== false ) { 
        echo('<p style="color: red;">'.htmlentities($_SESSION['fail'])."</p>\n");               //Flash messages pattern
        unset($_SESSION['fail']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>03e9330e</title>
</head>
<body>
    <form method="post">

<input type="text" name="email" id="">
<input type="password" name="pass" id="">
<input type="submit" value="Log In">     
</form>
<a href="index.php">Cancel </a>
</body>
</html>