<?php
require('config.php');
$codep=$_POST['codep'] ;
$sqla = "SELECT COUNT(*) from likes where codep=$codep";
                    $tablea = $pdo->query($sqla);
                    while ($rowa = $tablea->fetch(PDO::FETCH_BOTH)) {
                        $likes = $rowa['COUNT(*)'];
                    }
                    echo "<script>
                    document.querySelector('.span$codep').innerHTML='$likes likes'
                </script>";
                echo  $codep;
?>
