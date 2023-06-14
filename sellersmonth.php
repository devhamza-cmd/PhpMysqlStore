
<?php
require('config.php');
$value = $_POST['value'];
if ($value < 10) {
    $value = "0$value";
}

echo "<script>document.querySelector('.input').value=$value</script>";
echo "<script>document.querySelector('.input2').value='pmonth$value'</script>";
echo "<script>document.querySelector('.input3').value='npmonth$value'</script>";
$sql = "SELECT count(id) from users where role='v' and date(date) between '2023-$value-01' and '2023-$value-31' 
";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(id)'];

}
echo "<script>document.querySelector('#value1').innerHTML=$max</script>";
echo "<script>document.querySelector('.nu').innerHTML='new sellers'</script>";
$avg = round(($max / 31),2);
echo "<script>
    document.querySelector('#value2').innerHTML='$avg'
</script>";

$sql = "SELECT COUNT(DISTINCT codev) from commande c,produit p where c.codepr=p.code and date(c.date) BETWEEN '2023-$value-01' and '2023-$value-31'  ;
";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['COUNT(DISTINCT codev)'];

}

echo "<script>document.querySelector('#value3').innerHTML=$max</script>";
$sql = "SELECT COUNT(*) from users where role='v' and id not in (SELECT DISTINCT codev from commande c,produit p where c.codepr=p.code AND date(c.date) BETWEEN '2023/$value/01' and '2023/$value/31' )  and role='v'";
$table = $pdo->query($sql);

while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['COUNT(*)'];

}
echo "<script>document.querySelector('#value4').innerHTML=$max</script>";
$sql = "SELECT day(date),count(id) from users where role='v' and date(date) between '2023-$value-01' and '2023-$value-31' GROUP by day(date) ORDER BY `count(id)` DESC limit 1";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['day(date)'];

}

echo "<script>document.querySelector('#value5').innerHTML=$max</script>";
echo "<script>document.querySelector('.best').innerHTML='AVG PER DAY'</script>";
echo "<script>document.querySelector('.best2').innerHTML='BEST DAY'</script>";
$sql = "SELECT count(id) from users where role='v' and date(date) between '2023-$value-01' and '2023-$value-31' GROUP by day(date) ORDER BY `count(id)` DESC limit 1
 


";
$max = 0;
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(id)'];

}

?>
   
<?php



echo "<div class='year'>";
for ($i = 1; $i <= 31; $i++) {
    if ($i < 10) {
        $sql = "SELECT count(id) from users where role='v' and date(date) like  '2023-$value-0$i'";
    } else {
        $sql = "SELECT count(id) from users where role='v' and date(date) like  '2023-$value-$i';
";
    }
    $x = 0;
    $table = $pdo->query($sql);
    
    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
        $x = $row['count(id)'];
    }
    $height = 0;
    if ($max>0){
        $height = ($x * 100) / $max;
    }
    
    $heightfinal = $height * 310 / 100;
    $heightfinal++;
    echo "<div  class='d-flex justify-content-center align-items-end' style='height: $heightfinal" . "px" . ";' ></div>";
}
echo "</div>";
echo "<div class='mounth'>";
for ($i = 1; $i <= 31;$i++){
    if ($i<10){
        echo "<button  value='2023-$value-0$i' >$i</button>";
    }else{
        echo "<button value='2023-$value-$i'>$i</button>";

    }
    
}
echo "</div>";
echo "<script>$(document).ready(function () {
   $('button').one('click', function () { 
       var value = $(this).val();
       $('.m').remove();
       $('.year').remove();
       $('.mounth').remove();
       $.ajax({
           url: 'sellersday.php', // URL of the PHP file
           method: 'POST', // HTTP method to use
           data: {value: value}, // Data to send to the PHP file
           success: function(response) {
               // Handle the response from the PHP file
               $('.cyear').html(response);
           },
           error: function(xhr, status, error) {
               // Handle errors, if any
               console.log('Error:', error);
           }
       });
   });
});
</script>";

    ?>
