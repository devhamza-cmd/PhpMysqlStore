
<?php
session_start();
$codeu=$_SESSION['user'];


require('config.php');
 $codep=$_POST['codep'];
 $cmnt=$_POST['cmnt'];
 $codecmnt=1;
 if (file_exists("codecmnt.txt")){
    $codecmnt=unserialize(file_get_contents("codecmnt.txt"));
 }else{
    file_put_contents("codecmnt.txt",serialize($codecmnt));
 } $codecmnt++;
 $coden=1;
 if (file_exists("coden.txt")){
    $coden=unserialize(file_get_contents("coden.txt"));
 }else{
    file_put_contents("coden.txt",serialize($coden));
 }
$coden++;
 $date=date('Y-m-d H:i:s');
 $sql="insert into comment values($codecmnt,$codeu,$codep,'$cmnt','$date')";
 $r=$pdo->prepare($sql);
 $r->execute();
 file_put_contents("codecmnt.txt",serialize($codecmnt));
 

      
 file_put_contents("coden.txt",serialize($coden));
 
  $sql="select codeu from post where codep=$codep";
  $table = $pdo->query($sql);
   while ($row = $table->fetch(PDO::FETCH_BOTH)) {
            $owner=$row['codeu'];
   }
   if ($codeu!=$owner){
      $sql="insert into notification values($coden,$owner,$codep,'new commment #$codep : $cmnt','$date',5)";
      $r=$pdo->prepare($sql);
      $r->execute();
   }

?>

