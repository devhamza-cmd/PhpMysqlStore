<?php 
require("config.php");
session_start();
$from=$_SESSION['user'];
$to=$_POST['to'];

$sql="select * from message m where m.from=$from and  m.to=$to OR m.from=$to and m.to=$from";
$table = $pdo->query($sql);
while ($row = $table->fetch(PDO::FETCH_BOTH)) {
    $f=$row['from'];
    $t=$row["to"];
    $txt=$row["text"];
    if ($f==$from){
        echo "<div class='you'>
        <img class='custom' src='https://static.vecteezy.com/system/resources/previews/008/442/086/original/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg' alt=''>
        <span>$txt</span>
       </div>";
    } else {
        echo "<div class='him'>
        <img class='custom' src='https://static.vecteezy.com/system/resources/previews/008/442/086/original/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg' alt=''>
         <span>$txt</span>
        </div>";
    }
} 

?>