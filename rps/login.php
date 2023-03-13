<?php
#pass used is php123
$salt='XyZzy12*_';
$storedhash='1a52e17fa899cf40fb04cfc42e6352f1';
if(isset($_POST['username']) && isset($_POST['password'])){
if ( strlen($_POST['username']) < 1 || strlen($_POST['password']) < 1 ) {
    $fail="password and username are required";
    } else {
        $check=hash('md5',$salt.$_POST['password']);
        if ( $check == $storedhash ) {  
            session_start();
            $_SESSION['user']=$_POST['username'];      
            header("Location: game.php?name=".urlencode($_POST['username']));
            return;
        }
        else{
            $fail="incorrect pass";
        }
    }
}
?>
<?php 

if ( $fail !== false ) {
    
    echo('<p style="color: red;">'.htmlentities($fail)."</p>\n");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">

<input type="text" name="username" id="">
<input type="password" name="password" id="">
<input type="submit" value="login">     

</form>
</body>
</html>