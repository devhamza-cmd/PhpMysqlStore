<?php
require('config.php');
session_start();
$user=$_SESSION['user'];
$codep=substr($_POST['codep'],1);

$sql="delete from likes where codep=$codep and codeu=$user ";
$r=$pdo->prepare($sql);
$r->execute();
$sqla = "SELECT COUNT(*) from likes where codep=$codep";
                    $tablea = $pdo->query($sqla);
                    while ($rowa = $tablea->fetch(PDO::FETCH_BOTH)) {
                        $likes = $rowa['COUNT(*)'];
                    }
                    echo "<script>document.querySelector('.span$codep').innerHTML='$likes likes'</script>";
?>
