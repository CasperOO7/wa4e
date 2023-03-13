<?php
require_once "../pdo/pdo.php";
if ( isset($_POST['email']) && isset($_POST['password'])  ) {
    echo("dont try sql injection wont work\n");
    $sql = "SELECT name FROM users
         WHERE email = :em AND password = :pw";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'],
        ':pw' => $_POST['password']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($row);
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