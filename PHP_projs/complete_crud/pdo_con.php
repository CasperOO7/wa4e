<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=misc','casper','king');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>