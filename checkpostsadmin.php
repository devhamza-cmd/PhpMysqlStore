
<?php

require('config.php');
$sql="select count(*) from post where statu='pending'";
$table = $pdo->query($sql);
$postnbr=0;
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $postnbr=$row['count(*)'];
}
echo $postnbr;

?>