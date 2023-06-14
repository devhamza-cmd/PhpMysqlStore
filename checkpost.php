<?php
require('config.php');
session_start();
$sql="select count(*) from post where statu='accept'";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $postnbr=$row['count(*)'];
        }
echo $postnbr;
?>