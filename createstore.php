<?php
require("config.php");
$id=$_POST["id"];
$store=$_POST["store"];
$img=$_POST["img"];
$codestore=16;
$date=date('Y-m-d H:i:s');
if (file_exists("codestore.txt")){
    $codestore=unserialize(file_get_contents("codestore.txt"));
}else{
    file_put_contents("codestore.txt",serialize($codestore));
}
$sql ="insert into store values($codestore,'$store',$id,'$date')";
$r=$pdo->prepare($sql);
print_r($r);
$r->execute();
$codestore++;
file_put_contents("codestore.txt",serialize($codestore));
?>