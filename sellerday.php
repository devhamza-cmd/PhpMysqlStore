<?php 
require("config.php");
session_start();
$user=$_SESSION["user"];
$day=$_POST['value'];
$month=$_POST['month'];
if ($month<10){
    $month="0$month";
}
if($day<10){
    $day="0$day";
}
$date="2023-$month-$day";

echo "<div class='year'>";
$sql="SELECT hour(date),sum(total) as 'total' from commande c,produit pr where c.codepr=pr.code and pr.codev=$user and date(c.date) like '$date'  order by total DESC limit 1;";
   
$max = 0;
$table = $pdo->query($sql); 
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
      $max = $row["total"];
      $bh=$row["hour(date)"];
}
$avg=round(($max/24),2);
for ($i = 0; $i < 24; $i++) {
    if ($i < 10) {
      $sql = "SELECT SUM(TOTAL) as  'total' FROM commande c,produit p WHERE c.date between '$date 0$i:00:00' and  '$date 0$i:59:59' and c.codepr=p.code and p.codev=$user;";
    } else {
        $sql = "SELECT SUM(TOTAL) as  'total' FROM commande c,produit p WHERE c.date between '$date $i:00:00' and  '$date $i:59:59' and c.codepr=p.code and p.codev=$user;";
    }
    $x = 0;
    $table = $pdo->query($sql);
    
    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
      $x = $row["total"];
    }
    
    if ($max>0){
      $height = ($x * 100) / $max;
    $heightfinal = $height * 310/ 100;
    }else{
      $heightfinal=0;
    }
    echo "<div  class='d-flex justify-content-center align-items-end' style='height: $heightfinal" . "px" . ";' ></div>";
  }
echo "</div>";
echo "<div class='mounth'>";
for ($i=0;$i<24;$i++){
    
    echo "<div class='month'>
    <button type='submit' class='dayseller'  value='$date'>$i</button>
</div>";
}
echo "</div>";
echo"<script>
$(document).ready(function () {
     let headers=document.querySelectorAll('h5')
     headers[1].innerHTML='$$max';
     headers[2].innerHTML='avg per hour';
     headers[3].innerHTML='$avg';
     headers[4].innerHTML='best hour';
     headers[5].innerHTML='$bh';
     headers[7].innerHTML='$max';
    
 });

</script>";
?>
