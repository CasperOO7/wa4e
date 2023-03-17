<?php
session_start();
$salt='XyZzy12*_';
$storedhash='1a52e17fa899cf40fb04cfc42e6352f1';
if(isset($_SESSION['user']))                        //if theres already user unset him
unset($_SESSION['user']);
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
        $check=hash('md5',$salt.$_POST['pass']);
        if ( $check == $storedhash ) {                                  //check if the password is correct {php123}
            error_log("Login success ".$_POST['email']);            
            $_SESSION['login']=$_POST['email'];
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
if(isset($_SESSION['fail'])){
    $fail=$_SESSION['fail'];
    }
    if ( $fail !== false ) { 
        echo('<p style="color: red;">'.htmlentities($fail)."</p>\n");               //Flash messages pattern
        unset($_SESSION['fail']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>191c1277</title>
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