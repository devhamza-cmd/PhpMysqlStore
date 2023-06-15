<?php 
require('config.php');
session_start();
$user=$_SESSION['user'];
$option=$_POST['name'];
$value=$_POST['month'];
if ($option=="month"){
    if ($value<10){
        $fv="0$value";
    } else {
        $fv="$value";
    }
    $sql="SELECT month(date),sum(total) as 'total' from commande c,produit pr where c.codepr=pr.code and pr.codev=$user and c.date BETWEEN '2023-$fv-01' and '2023-$fv-31' GROUP BY month(date) order by total DESC limit 1;";
   
    $max = 0;
    
    $table = $pdo->query($sql); 
    
    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
          $max = $row["total"];
    }
    $sql="SELECT day(Date),Sum(Total) As 'Total' From Commande C,Produit Pr Where C.Codepr=Pr.Code And Pr.Codev=$user And C.Date BETWEEN '2023-$fv-01' And '2023-$fv-31' GROUP BY day(Date) Order By Total DESC Limit 1;";
    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
        $bd = $row["day(Date)"];
        $bestb=$row["Total"];
  }
  
    $avg=round(($max/30),2);
    
    echo "<script>
    document.getElementById('balance').innerHTML='$$max';
    document.getElementById('avg').innerHTML='avg per day';
    let moneydiv=document.querySelectorAll('.moneydiv');
    document.getElementById('avg').innerHTML='$avg';
    document.getElementById('bm').innerHTML='best day';
    document.getElementById('dayname').innerHTML='$bd';
    document.getElementById('bc').innerHTML='$$bestb';
    moneydiv[1].remove();
    </script>";
    echo "<div class='year'>";
    for ($i = 1; $i < 25; $i++) {
        if ($i < 10) {
          $sql = "SELECT SUM(TOTAL) as  'total' FROM commande c,produit p WHERE date(c.date) like '2023-$fv-0$i'  and c.codepr=p.code and p.codev=$user;";
        } else {
          $sql = "SELECT SUM(TOTAL) as  'total' FROM commande c,produit p WHERE date(c.date) like '2023-$fv-$i'  and c.codepr=p.code and p.codev=$user";
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
    for($i=1 ;$i<=24;$i++){
        echo " <button type='submit' month=$value class='sellerday'  value='$i'>$i</button>";
    }
    echo "</div>";
}

?>
<script>
    $(document).ready(function () {
        let daysbtn=document.querySelectorAll(".sellerday");
        daysbtn.forEach(element => {
            element.addEventListener('click',()=>{
                var value=element.value;
                
                var option=element.getAttribute('class');
                var month=element.getAttribute('month');
                $.ajax({
            url: "sellerday.php",
            method: "POST", 
            data: {value:value,option:option,month:month}, 
            success: function(response) {
              
                $(".cyear").html(response);
            },
            error: function(xhr, status, error) {
              
                console.log("Error:", error);
            }
        });
            })
        });
        })  
</script>
