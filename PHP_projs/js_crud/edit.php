<?php
require_once "pdo_con.php";
session_start();
if(isset($_POST['logout'])){
    header("Location: logout.php");
}

if (!isset($_GET['profile_id']) ) {
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
 }

if ( isset($_POST['first_name']) && isset($_POST['last_name'])                                                            //validate data for updating
     && isset($_POST['email']) && isset($_POST['headline'])
     && isset($_POST['summary']) ) {

        if ( strlen($_POST['first_name']) < 1 ||
         strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1|| strlen($_POST['headline']) < 1) {
            $_SESSION['error'] = 'All fields are required';
            header("Location: edit.php?profile_id=".$_POST['profile_id']);
            return;
        }
      
        $sql = "UPDATE profile SET first_name = :first_name,
        last_name = :last_name, email = :email ,headline=:headline ,summary=:summary
        WHERE profile_id = :profile_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    ':first_name' => $_POST['first_name'],
    ':last_name' => $_POST['last_name'],
    ':email' => $_POST['email'],
    ':headline' => $_POST['headline'],
    ':summary' => $_POST['summary'],
    ':profile_id' => $_POST['profile_id']));
        
    
$_SESSION['success'] = 'Record edited';
header( 'Location: index.php' ) ;
return;
    }
     
     $stmt = $pdo->prepare("SELECT * FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header( 'Location: index.php' ) ;
    return;
}
//view starting here
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['first_name']);
$e = htmlentities($row['last_name']);
$p = htmlentities($row['email']);
$m = htmlentities($row['headline']);
$s = htmlentities($row['summary']);
$profile_id = htmlentities($row['profile_id']);

?>

<html>
<p>Edit A Record</p>
<title>03e9330e</title>
    <form method="post">
    <p>first name:<input type="text" name="first_name" size="40" value="<?= $n ?>"></p>
    <p>last name:<input type="text" name="last_name" size="40" value="<?= $e?>"></p>
    <p>email:<input type="text" name="email" value="<?= $p?>"></p>
    <p>headline:<input type="text" name="headline" value="<?= $m?>"></p>
    <p>summary:<br><textarea  name="summary" ><?= $s?></textarea></p>
    <input type="hidden" name="profile_id" value="<?= $profile_id?>">
    <input type="submit" value="Save">
    <input type="submit" name ="logout" value="logout">
    </form>
    </html>