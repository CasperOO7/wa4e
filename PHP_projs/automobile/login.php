<?php
#pass used is php123
$fail=false;
$salt='XyZzy12*_';
$storedhash='1a52e17fa899cf40fb04cfc42e6352f1';
if(isset($_POST['email']) && isset($_POST['password'])){
if ( strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1 ) {
    $fail="password and email are required";
    }
    if(strstr($_POST['email'],'@')===false){
        $fail="unvalid email";  
    } 
    else
    {
        $check=hash('md5',$salt.$_POST['password']);
        if ( $check == $storedhash ) {  
            error_log("Login success ".$_POST['email']);
            header("Location: autos.php?email=".urlencode($_POST['email']));
            return;
        }
        else{
            $fail="incorrect pass";
            error_log("Login fail ".$_POST['email']." $check");
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
    <form method="post">

<input type="text" name="email" id="">
<input type="password" name="password" id="">
<input type="submit" value="login">     

</form>
</body>
</html>