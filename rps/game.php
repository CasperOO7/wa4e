<?php  
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing wtf ');
}
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}


?>