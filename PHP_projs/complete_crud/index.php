<?php                                                                                           //model
require_once "pdo_con.php";
session_start();
$logged=true;
if(!isset($_SESSION['login'])){
$logged=false;
}
?>
<html>                                                                                          <!--view-->
    <head></head>
    <body> 
        <title>eca02a9e</title>  
    <table border="1">
<?php
if($logged==false){
echo('
<h1>Welcome to autos database</h1>
<a href="./login.php">Please log in</a>'
);
return;
}
if(isset($_SESSION['success'])){
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);}

$view = $pdo->query("SELECT autos_id, make,model,year,mileage FROM autos ORDER BY make");
while($row=$view->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo($row['make']);
    echo("</td><td>");
    echo($row['model']);
    echo("</td><td>");
    echo($row['year']);
    echo("</td><td>");
    echo($row['mileage']);
    echo("</td><td>\n");
    echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
    echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
?>  
<a href="./add.php">Add New Entry <br> </a>
<a href="./logout.php">Logout</a>
    </body>
</html>
