<?php
require_once "pdo.php";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
$sql="INSERT INTO users (name,email,password) VALUES (:name,:email,:password)";
echo("<pre>\n".$sql."\n</pre>\n");
$loader=$pdo->prepare($sql);
$loader->execute(array(
    ':name'=>$_POST['name'],
    ':email'=>$_POST['email'],
    ':password'=>$_POST['password']
));
}
if(isset($_POST['user_id']) && isset($_POST['delete'])){
$sql="DELETE FROM users WHERE user_id=:zip";
$rocket=$pdo->prepare($sql);
$rocket->execute(array(':zip'=>$_POST['user_id']));
}
?>
<html>
    <head></head>
    <body>   
    <table border="1">
<?php
$view = $pdo->query("SELECT name, email, password ,user_id FROM users");
while($row=$view->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo($row['name']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td><td>");
    echo($row['password']);
    echo("</td><td>\n");

    echo(' <form method="post"> <input type="hidden" ');
    echo('name="user_id" value="'.$row['user_id'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
    <p>Add A New User</p>
    <form method="post">
    <p>Name:<input type="text" name="name" size="40"></p>
    <p>email:<input type="text" name="email" ></p>
    <p>password:<input type="password" name="password" ></p>
    <input type="submit" value="add new user">
    </form>
    
    </body>