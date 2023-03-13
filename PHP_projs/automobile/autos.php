<?php  
require_once "pdo.php";
$fail=false;
if (!isset($_GET['email']) || strlen($_GET['email']) < 1  ) {
   die('WTF!?, get the fuck out of here WHO THE FUCK ARE YOU ');
}
if (isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}
if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['millage'])){
    if(!is_numeric($_POST['year'])||!is_numeric($_POST['millage'])){
        $fail="Mileage and year must be numeric";
        if( ! isset($_POST['make']) || strlen($_POST['make']) < 1  ){
            $fail="Make is required";
        }
    }
    else
    {
$sql="INSERT INTO
 autos (make,year,millage) 
 VALUES (:make,:year,:millage)";
$loader=$pdo->prepare($sql);
$loader->execute(array(
    ':make'=>$_POST['make'],
    ':year'=>$_POST['year'],
    ':millage'=>$_POST['millage']
));
}}
if(isset($_POST['auto_id']) && isset($_POST['delete'])){ 
$sql="DELETE FROM 
autos 
WHERE auto_id=:zip";
$rocket=$pdo->prepare($sql);
$rocket->execute(array(':zip'=>$_POST['auto_id']));
}
?>
 <?php echo('<p style="color: red;">'.htmlentities($fail)."</p>\n");?>

<html>
    <head></head>
    <body>   
    <table border="1">
<?php
$view = $pdo->query("SELECT make, year, millage ,auto_id FROM autos ORDER BY make");
while($row=$view->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";

    echo($row['make']);

    echo("</td><td>");
    echo($row['year']);
    echo("</td><td>");
    echo($row['millage']);
    echo("</td><td>\n");
    echo(' <form method="post"> <input type="hidden" ');
    echo('name="auto_id" value="'.$row['auto_id'].'">'."\n");
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
    <p>Add A New auto</p>

    <form method="post">
    <p>make:<input type="text" name="make" size="40"></p>
    <p>year:<input type="text" name="year" ></p>
    <p>millage:<input type="text" name="millage" ></p>
    <input type="submit" value="Add">
    <input type="submit" name ="logout" value="logout">
    </form>
    </body>
</html>
