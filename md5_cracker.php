<pre>
<?php
if (isset($_GET['hash'])){
$time_pre = microtime(true);
$gotcha = "nothing";
$md5 = $_GET['hash'];
$num = "0123456789";
for ($l1 = 0; $l1 < strlen($num); $l1++) {
    $n1 = $num[$l1];
    for ($l2 = 0; $l2 < strlen($num); $l2++) {
        $n2 = $num[$l2];
        for ($l3 = 0; $l3 < strlen($num); $l3++) {
            $n3 = $num[$l3];
            for ($l4 = 0; $l4 < strlen($num); $l4++) {
                $n4 = $num[$l4];
                $try = $n1 . $n2 . $n3 . $n4;
                $check = hash('md5', $try);
                if ($check == $md5) {
                    $gotcha = $try;
                    $time_post = microtime(true);
                    $time_elapsed = $time_post-$time_pre; 
                    break;
                }
                
            }
        }
    }
}
echo "I OWNED YOU: " . $gotcha . "<br>"."in exactly: $time_elapsed secounds";
}
else
echo "no hash yet";

?>
</pre>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hash_reverser</title>
</head>

<body>
    <h1>This app cracking md5 hashes of 4 numbers</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">

        <input type="text" name="hash" id="">
        <input type="submit" value="CRACK!">


    </form>
</body>

</html>