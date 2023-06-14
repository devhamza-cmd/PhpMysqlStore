<?php
require("config.php");
session_start();
$from=$_SESSION['user'];
$to=$_POST['to'];

$sql="select count(*) from message m where m.from=$from and  m.to=$to OR m.from=$to and m.to=$from";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $count=$row['count(*)'];
}
echo $count;
 ?>