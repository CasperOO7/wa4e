<?php 
require_once "../pdo.php";
if ( isset($_POST['email']) && isset($_POST['password']) ) {
   $e = $_POST['email'];
   $p = $_POST['password'];
   $sql = "SELECT name FROM users
        WHERE email = '$e'
        AND password = '$p'
        ";
        echo "<pre>\n$sql\n</pre>\n";
   $stmt = $pdo->query($sql);
   //print_r($row=$stmt->fetch(PDO::FETCH_ASSOC));
   //echo  $stmt->rowCount();
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
    <p>email:<input type="text" name="email" ></p>
    <p>password:<input type="password" name="password" ></p>
    <input type="submit" value="login">
    </form>

    
   </body>
   </html>