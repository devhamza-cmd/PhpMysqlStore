<?php
require("config.php");
session_start();
$user=$_SESSION['user'];
$sql="select count(*) from notification where codeu=$user and type_ntf in(2,4,5)";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $new=$row['count(*)'];
}
$defult=$_POST['defult'];
echo $new;
if ($new>$defult){
echo "<script>
document.querySelector('.ntf').innerHTML='$new';
document.querySelector('.ntfcont').innerHTML='your get a new notification ';
document.querySelector('.ntfcont').style.cssText='display: flex; justify-content: center; align-items: center;';
setTimeout(()=>{    
 document.querySelector('.ntfcont').style.cssText='display: none; ';
 document.querySelector('.ntfcont').innerHTML='';
},4000);</script>";
}
?>
<script>
   
</script>
