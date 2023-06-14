
<?php
require('config.php');
$value = $_POST['value'];
$sql = "SELECT count(*) FROM users WHERE DATE(date) LIKE '$value' and role='u';
";

echo "<script>document.querySelector('.input').value='$value'</script>";
echo "<script>document.querySelector('.input2').value='pday$value'</script>";
echo "<script>document.querySelector('.input3').value='npday$value'</script>";
$table = $pdo->query($sql);


while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(*)'];

}
$avg =round(($max / 24),2);

$sql = "SELECT count(*) FROM users where date(date) like '$value' and role='u'";

$table = $pdo->query($sql);

while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(*)'];

}
echo "<script>document.querySelector('#value1').innerHTML='$max'</script>";
echo "<div class='year'>";
$sql = "SELECT count(*) FROM users where date BETWEEN '$value 00:00:00' and '$value 23:59:59' and role='u' GROUP by hour(date)";
$max = 0;
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(*)'];

}
for ($i = 0; $i <24; $i++) {
    $x = 0;
    if($i<10){
        $sql = "select count(id) from users where date between '$value 0$i:00:00' and '$value 0$i:59:59' and role='u' ";
    } else{
        $sql = "select count(id) from users where date between '$value $i:00:00' and '$value $i:59:59' and role='u' ";
    }
    $table = $pdo->query($sql);
    while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
        $x = $row['count(id)'];
    }
    
    $height = 0;
    if ($max > 0) {
        $height = ($x * 100) / $max;
    }
    $heightfinal = $height * 310 / 100;
    $heightfinal++;
    
    
    echo "<div  class='d-flex justify-content-center align-items-end' style='height: $heightfinal" . "px" . ";' ></div>";
}
echo "</div>";
echo "<div class='mounth'>";
for ($i = 0; $i < 24; $i++) {
    echo "<button >$i</button>";
}
echo "</div>";

echo "<script>document.querySelector('#value2').innerHTML='$avg'</script>";


$sql = "SELECT count(*) from users where id in (SELECT DISTINCT codeu from commande c where date(c.date) like '$value')";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(*)'];

}

echo "<script>document.querySelector('#value3').innerHTML='$max'</script>";
$sql = "SELECT  count(DISTINCT id)  FROM users u  WHERE u.id not in()";
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(*)'];

}
// 
$sql = "SELECT Count(*),hour(date) FROM Users Where Date BETWEEN '$value 00:00:00' And '$value 23:59:59' And Role='U' GROUP By Hour(Date)";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $x = $row['hour(date)'];
}
echo "<script>document.querySelector('#value5').innerHTML='$x'</script>";
echo "<script>document.querySelector('.best2').innerHTML='BEST HOUR'</script>";
echo "<script>document.querySelector('.best').innerHTML='AVG PER HOUR'</script>";
$sql = "SELECT   count(DISTINCT id) FROM users u  ,commande c WHERE u.id not  in(SELECT DISTINCT codeu from commande c where date(c.date) like '$value') and role='u'";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_ASSOC)) {
    $max = $row['count(DISTINCT id)'];

}
echo "<script>document.querySelector('#value4').innerHTML=$max</script>";
    ?>
