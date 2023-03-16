<?php
require_once "pdo.php";
session_start();
$fail=false;
if (!isset($_SESSION['login'])) {
   die('WTF!?, get the fuck out of here WHO THE FUCK ARE YOU ');
}
if (isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}
if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){
    if( ! isset($_POST['make']) || strlen($_POST['make']) < 1  ){
        $_SESSION['fail']="Make is required";
    header("Location: ./add.php");
    return;
    }
    if(!is_numeric($_POST['year'])||!is_numeric($_POST['mileage'])){
        $_SESSION['fail']="Mileage and year must be numeric";
        header("Location: ./add.php");
        return;
        
    }
    else
    {
$sql="INSERT INTO
 autos (make,year,mileage) 
 VALUES (:make,:year,:mileage)";
$loader=$pdo->prepare($sql);
$loader->execute(array(
    ':make'=>htmlentities($_POST['make']),
    ':year'=>htmlentities($_POST['year']),
    ':mileage'=>htmlentities($_POST['mileage'])
));
$_SESSION['success']="successfully added \n";
}}
?>
 <?php 
 if(isset($_SESSION['fail'])){
    $fail=$_SESSION['fail'];
 echo('<p style="color: red;">'.htmlentities($fail)."</p>\n");
 unset($_SESSION['fail']);
}
if(isset($_SESSION['success'])){
header("Location: ./view.php");
return;
}
 ?>
 <p>Add A New auto</p>
<title>191c1277</title>
    <form method="post">
    <p>make:<input type="text" name="make" size="40"></p>
    <p>year:<input type="text" name="year" ></p>
    <p>mileage:<input type="text" name="mileage" ></p>
    <input type="submit" value="Add">
    <input type="submit" name ="logout" value="logout">
    </form>