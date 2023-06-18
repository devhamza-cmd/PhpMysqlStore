<?php
require("config.php");
$id = $_POST["id"];
$store = $_POST["store"];
$img = $_POST["img"];
$img = str_replace('data:image/jpeg;base64,', '', $img);
$imageData = base64_decode($img);
$codestore = 16;
$date = date('Y-m-d H:i:s');

if (file_exists("codestore.txt")) {
    $codestore = unserialize(file_get_contents("codestore.txt"));
} else {
    file_put_contents("codestore.txt", serialize($codestore));
}

$sql = "INSERT INTO `store`(`codestore`, `nom`, `codev`, `date`, `image`) VALUES (?, ?, ?, ?, ?)";
$r = $pdo->prepare($sql);
$r->execute([$codestore, $store, $id, $date, $imageData]);
$codestore++;
file_put_contents("codestore.txt", serialize($codestore));
?>
