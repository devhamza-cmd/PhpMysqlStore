<?php
require("config.php");
session_start();
$codemsg = 0;
if (file_exists('codemsg.txt')) {
    $codemsg = unserialize(file_get_contents('codemsg.txt'));
} else {
    file_put_contents('codemsg.txt', serialize($codemsg));
}
$from = $_SESSION['user'];
$to = $_POST['to'];
$msg = $_POST['txt'];
if ($to == "") {
    echo "<script>alert('chose a distination')</script>";
} else {
    $sql = "insert into message values($codemsg,$from,$to,'$msg')";
    $r = $pdo->prepare($sql);
    $r->execute();
    $codemsg++;
    file_put_contents("codemsg.txt", serialize($codemsg));
    
}

?>