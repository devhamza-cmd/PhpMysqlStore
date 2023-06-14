
<?php

require('config.php');
session_start();

$date = date('Y-m-d H:i:s');
$user = $_SESSION['user'];
$codep = substr($_POST['codep'], 1);
$coden = 1;
if (file_exists("coden.txt")) {
    $coden = unserialize(file_get_contents("coden.txt"));
} else {
    file_put_contents("coden.txt", serialize($coden));
}

$sql = "insert into likes values($user,$codep)";
$r33 = $pdo->prepare($sql);


$sqla = "SELECT COUNT(*) from likes where codep=$codep";
$tablea = $pdo->query($sqla);
while ($rowa = $tablea->fetch(PDO::FETCH_BOTH)) {
    $likes = $rowa['COUNT(*)'];
}
echo "<script>document.querySelector('.span$codep').innerHTML='$likes likes'</script>";
?>
<?php
$sql = "SELECT codeu from post WHERE codep=$codep";

$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $check = $row['codeu'];
}

$coden++;
if ($check != $user) {
    $sql = "SELECT count(*) FROM `notification` WHERE text like '%$user%' and type_ntf=4 and codep=$codep;
    ";
    $table = $pdo->query($sql);
   
    while ($row = $table->fetch(PDO::FETCH_BOTH)) {
        $count = $row['count(*)'];
    }
    
    
    if ($count==0) {
        $sql = "insert into notification values($coden,$check,$codep,'new like #$codep : you get a new like from #$user','$date',4)";
        $r = $pdo->prepare($sql);

        $r->execute();
        $r33->execute();
        file_put_contents("coden.txt", serialize($coden));
    }else{
        $r33->execute();
    }


}else{
        $r33->execute();
    }
?>