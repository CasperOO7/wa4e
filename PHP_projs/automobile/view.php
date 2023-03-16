<?php  
require_once "pdo.php";
session_start();
if(!isset($_SESSION['login']))
die('WTF!?, get the fuck out of here WHO THE FUCK ARE YOU v ');
if(isset($_POST['auto_id']) && isset($_POST['delete'])){ 
$sql="DELETE FROM 
autos 
WHERE auto_id=:zip";
$rocket=$pdo->prepare($sql);
$rocket->execute(array(':zip'=>$_POST['auto_id']));
}
?>
<html>
    <head></head>
    <body> 
        <title>191c1277</title>  
    <table border="1">
<?php
if(isset($_SESSION['success'])){
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
$view = $pdo->query("SELECT make, year, mileage ,auto_id FROM autos ORDER BY make");
while($row=$view->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo($row['make']);
    echo("</td><td>");
    echo($row['year']);
    echo("</td><td>");
    echo($row['mileage']);
    echo("</td><td>\n");
    echo(' <form method="post"> <input type="hidden" ');
    echo('name="auto_id" value="'.$row['auto_id'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>  
<a href="./add.php">Add New</a>
<a href="./logout.php">Logout</a>
    </body>
</html>
