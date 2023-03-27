<?php                                                                                           //model
require_once "pdo_con.php";
session_start();
if(isset($_SESSION['name'])){
    if(isset($_SESSION['error'])){
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])){
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }
    $id=$_SESSION['user_id'];
     $view = $pdo->query("SELECT first_name,last_name,headline,profile_id from profile WHERE user_id=$id ORDER BY first_name");
     echo('<html>                                                                                          <!--view-->
     <head></head>
     <body> 
         <title>eca02a9e</title>
     <table border="1">');
     while($row=$view->fetch(PDO::FETCH_ASSOC)) {
        echo("<tr>
            <td>name</td>
            <td>headline</td>
            <td>action</td>
        </tr>");
        echo "<tr><td>";
        echo('<a href="view.php?profile_id='.$row['profile_id'].'">'.$row['first_name']." ".$row['last_name'].'</a></td>');
        echo("<td>");
        echo($row['headline']);
        echo("</td>\n");
        echo("<td> ".'<a href="edit.php?profile_id='.$row['profile_id'].'">edit</a> / ');
        echo('<a href="delete.php?profile_id='.$row['profile_id'].'">delete</a></td> </tr>'); 
    }
        echo('</body>
        </html>');
     echo('<a href="add.php">Add New Entry</a><br>');
     echo('<a href="logout.php">logout </a>');  
}
else{
    
    $view = $pdo->query("SELECT first_name,last_name,headline,profile_id from profile ORDER BY first_name");
    echo('<html>                                                                                          <!--view-->
    <head></head>
    <body> 
        <title>03e9330e</title>
    <table border="1">');
 while($row=$view->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo('<a href="view.php?profile_id='.$row['profile_id'].'">'.$row['first_name']." ".$row['last_name'].'</a></td>');
    echo("<td>");
    echo($row['headline']);
    echo("</td></tr>\n");
}
    echo('</body>
    </html>');
    if(!isset($_SESSION['name'])){
        echo('<a href="login.php">Please log in</a>');  
    }
}
?>