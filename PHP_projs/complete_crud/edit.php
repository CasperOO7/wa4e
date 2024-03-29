<?php
require_once "pdo_con.php";
session_start();
if ( isset($_POST['make']) && isset($_POST['model'])                                                            //validate data for updating
     && isset($_POST['year']) && isset($_POST['mileage'])
     && isset($_POST['autos_id']) ) {
        if ( strlen($_POST['make']) < 1 ||
         strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1|| strlen($_POST['mileage']) < 1) {
            $_SESSION['error'] = 'All fields are required';
            header("Location: edit.php?autos_id=".$_POST['autos_id']);
            return;
        }
        $sql = "UPDATE autos SET make = :make,
        model = :model, year = :year , mileage =:mileage
        WHERE autos_id = :autos_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
    ':make' => $_POST['make'],
    ':model' => $_POST['model'],
    ':year' => $_POST['year'],
    ':mileage' => $_POST['mileage'],
    ':autos_id' => $_POST['autos_id']));
$_SESSION['success'] = 'Record edited';
header( 'Location: index.php' ) ;
return;
     }
     if ( ! isset($_GET['autos_id']) ) {
        $_SESSION['error'] = "Missing autos_id";
        header('Location: index.php');
        return;
     }
     $stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['make']);
$e = htmlentities($row['model']);
$p = htmlentities($row['year']);
$m = htmlentities($row['mileage']);
$autos_id = htmlentities($row['autos_id']);
?>


<html>
<p>Edit A Record</p>
<title>eca02a9e</title>
    <form method="post">
    <p>make:<input type="text" name="make" size="40" value="<?= $n ?>"></p>
    <p>model:<input type="text" name="model" size="40" value="<?= $e?>"></p>
    <p>year:<input type="text" name="year" value="<?= $p?>"></p>
    <p>mileage:<input type="text" name="mileage" value="<?= $m?>"></p>
    <input type="hidden" name="autos_id" value="<?= $autos_id?>">
    <input type="submit" value="Save">
    <input type="submit" name ="logout" value="logout">
    </form>
    </html>