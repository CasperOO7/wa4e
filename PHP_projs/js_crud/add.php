<?php
require_once "pdo_con.php";
session_start();
$fail=false;
if (!isset($_SESSION['name'])) {
   die('ACCESS DENIED');
}
if (isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}
if ( isset($_POST['first_name']) && isset($_POST['last_name'])                                                            //validate data for updating
     && isset($_POST['email']) && isset($_POST['headline'])
     && isset($_POST['summary']) ) {
        if ( strlen($_POST['first_name']) < 1 ||
         strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1|| strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
            $_SESSION['fail'] = 'All fields are required';
            header("Location: add.php");
            return;
        }  
        $sql = "INSERT into profile (user_id,first_name,last_name,email,headline,summary)
       values(:user_id,:first_name,:last_name,:email,:headline,:summary)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    ':first_name' => $_POST['first_name'],
    ':last_name' => $_POST['last_name'],
    ':email' => $_POST['email'],
    ':headline' => $_POST['headline'],
    ':summary' => $_POST['summary'],
    ':user_id' => $_POST['user_id']
));
        
$_SESSION['success'] = 'added';
header( 'Location: index.php' ) ;
return;
}
?>
 <?php 
 if(isset($_SESSION['fail'])){
    $fail=$_SESSION['fail'];
 echo('<p style="color: red;">'.htmlentities($fail)."</p>\n");
 unset($_SESSION['fail']);
}
if(isset($_SESSION['success'])){
header("Location: ./index.php");
return;
}
 ?>
 <html>
<p>Edit A Record</p>
<title>03e9330e</title>
    <form method="post">
    <p>first name:<input type="text" name="first_name" size="40" ></p>
    <p>last name:<input type="text" name="last_name" size="40" ></p>
    <p>email:<input type="text" name="email" ></p>
    <p>headline:<input type="text" name="headline"></p>
    <p>summary:<br><textarea  name="summary" ></textarea></p>
    <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
    <input type="submit" value="Add">
    <input type="submit" name ="logout" value="logout">
    </form>
    </html>