<?php 
require("config.php");
$sql="SELECT p.code as 'p',s.codestore as 's'  FROM produit p,store s WHERE p.codev=s.codev";
$l=[];
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $codev=$row["s"];
    $pcodev=$row['p'];
    
    $sql="update produit set codev=$codev where code=$pcodev   ";
    $r=$pdo->prepare($sql);
    print_r($r);
    $r->execute();
}
print_r($l);
?>