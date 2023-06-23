<?php
require("config.php");
$codestore=$_POST['codestore'];
$newname=$_POST['newname'];
$sql="update store  set nom='$newname' where codestore=$codestore";

$r=$pdo->prepare($sql);
$r->execute();
?>