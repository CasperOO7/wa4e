<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>de1fd875</title>
</head>

<body>
  <?php
if(!isset($_GET['guess']))
echo "Missing guess parameter";
elseif(strlen($_GET['guess'])<1)
echo "Your guess is too short";
elseif(!is_numeric($_GET['guess']))
echo "Your guess is not a number";
elseif($_GET['guess']<64)
echo "Your guess is too low";
elseif($_GET['guess']>64)
echo "Your guess is too high";
else
echo "Congratulations - You are right";
?>
</body>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
<input type="text" name="guess" id="">
<input type="submit" value="try to guess">

</form>


</html>